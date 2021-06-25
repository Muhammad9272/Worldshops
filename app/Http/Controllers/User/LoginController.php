<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use Hash;
use Exception;
use Twilio\Rest\Client;



class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'sendMessage','userLogout']]);
    }

    public function showLoginForm()
    {
      $this->code_image();
      return view('front.login');
    }


    public function showVendorLoginForm()
    {
      $this->code_image();
      return view('vendor.login');
    }

    public function login(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        //--- Validation Section
        $rules = [
                  'email'   => 'required|email',
                  'password' => 'required'
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
      // Check seller login  
      if(!empty($request->vendor)){
        $user=User::where('email',$request->email)->first();
        if($user && !$user->IsVendor()){
           return response()->json(array('errors' => [ 0 => 'Your are not Authenticated User !' ]));
        }
      }
      // Attempt to log the user in
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location

        // Check If Email is verified or not
          if(Auth::guard('web')->user()->email_verified == 'No')
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));   
          }

          if(Auth::guard('web')->user()->ban == 1)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Account Has Been Banned.' ]));   
          }
          if(Auth::guard('web')->user()->is_authentication == 1){
            if(Auth::guard('web')->user()->login_count%$gs->verification_link_expire==0 ){   
              
              $token_code=rand(11280,98500);
              $user=User::findOrFail(Auth::id());
              $user->authentication_code=$token_code;
              $user->update();
              //Send Verification Code to phone number
              if($user->phone){
                $sphone=$user->phone;
                $msg="Dear Customer, Your Verfication code is " .$token_code;

                $this->sendMessage($msg,$sphone);
              }
              //Send Verification Code to phone number ends

              Auth::guard('web')->logout();


                    $to = $request->email;
                    $subject = 'Verify your email address.';
                    $msg = "Dear Customer,<br> We noticed that you need to verify your email address.This is your  Verification Code " .$token_code;
                    //Sending Email To Customer
                    if($gs->is_smtp == 1)
                    {
                      $data = [
                          'to' => $to,
                          'subject' => $subject,
                          'body' => $msg,
                      ];

                      $mailer = new GeniusMailer();
                      $mailer->sendCustomMail($data);
                    }
                    else
                    {
                      $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                      mail($to,$subject,$msg,$headers);
                    }
              


              $data[3]=5;
              $data[0]=$request->email;
              $data[111]=route('resend-authentication-code',$request->email);
              return response()->json($data);
            }
            else{
                 $userdata=Auth::user();
                 // $userdata->is_auth_check=1;
                 $userdata->login_count=$userdata->login_count+1;
                 $userdata->update();

            }
          }

          // Login Via Modal
          if(!empty($request->modal))
          {
             // Login as Vendor
            if(!empty($request->vendor))
            {
              if(Auth::guard('web')->user()->is_vendor == 2)
              {
                return response()->json(route('vendor-dashboard'));
              }
              else {
                return response()->json(route('front.index'));
                }
            }
          // Login as User
          return response()->json(1);          
          }
          // Login as User
          return response()->json(route('user-dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
          return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));     
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }




   // public function AuthenticationPage($token)
   // {

   //    $today = Carbon::now()->format('Y-m-d H:i:s');                  
   //    $link_expire = date('Y-m-d H:i:s', strtotime($today));

   //    $userdata = User::where('authentication_link','=',$token)->first();
      
   //    if($userdata->authentication_expire>=$link_expire){
   //      $checkverify=1;
   //      return view('front.two-factor',compact('userdata','checkverify'));
   //    }
   //    else{
   //      $checkverify=0;

   //       return view('front.two-factor',compact('userdata','checkverify'));
   //    }
     
   //  }
    public function Authenticationtoken(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);

        $user = User::where('authentication_code','=',$request->token_code)->where('email',$request->email)->first();
        if(isset($user))
        {
           // $user->is_auth_check = 1;
           $user->login_count=$user->login_count+1;
           $user->update();

            Auth::guard('web')->login($user); 
            if(!empty($request->modalchkout) ){
             return response()->json(1);
            }
            else if($user->IsVendor()){
             $data[0]=route('vendor-dashboard');
            }

            else{
              $data[0]=route('user-dashboard');
            }
            
            $data[1]=2;
            return response()->json($data);
        }
        else {
            $msg="Invalid Code";
            return response()->json($msg);
        }

    
    }



    public function NewAuthenticationtoken($email){
        $userdata = User::where('email','=',$email)->first();
        $token_code=rand(11280,98500);
         $gs = Generalsetting::findOrFail(1);
        if($userdata && $userdata->is_authentication == 1)
          {
              //Send Verification Code to phone number
              if($userdata->phone){
                $sphone=$userdata->phone;
                $msg="Dear Customer, Your Verfication code is " .$token_code;

                $this->sendMessage($msg,$sphone);
              }
              //Send Verification Code to phone number ends


          $to = $userdata->email;
          // $subject = 'Two Factor Authentication.';
          // $msg = "Dear Customer,<br> Two Factor Authentication is enabled on your account.This is your  Authentication Code ".$token_code;
          $subject = 'Verify your email address.';
          $msg = "Dear Customer,<br> We noticed that you need to verify your email address.This is your  Verification Code " .$token_code;
          //Sending Email To Customer
            if($gs->is_smtp == 1)
            {
              $data = [
                  'to' => $to,
                  'subject' => $subject,
                  'body' => $msg,
              ];

              $mailer = new GeniusMailer();
              $mailer->sendCustomMail($data);
            }
            else
            {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
            }

           $userdata->authentication_code=$token_code;
           $userdata->is_auth_check=1;
           $userdata->update();
          //  $today = Carbon::now()->format('Y-m-d H:i:s');                  
          // return redirect()->route('authentication-code-token',$userdata->authentication_link);
       }
       else{
        return redirect()->back();
       }     
      
    }



   public function showVendorPasswordForm($token)
   {
      $datap=User::where('vendor_new_password_link',$token)->first();
      return view('vendor.new-password',compact('datap'));
   }
    public function VendorPasswordupdate(Request $request)
    {

        $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $user = User::where(['email' => $request->email, 'vendor_new_password_link' => $request->token])
                        ->first();

      if(!$user){
        return response()->json(array('errors' => [ 0 => 'Invalid token!' ]));
      }
      else{
         
          $user->password=Hash::make($request->password);
          $user->vendor_new_password_link="";
          $user->update();          

         Auth::guard('web')->login($user); 

        $data[0]=route('vendor-dashboard');
        $data[2]="Your password has been changed!";
        $data[3]=5;        
        
        return response()->json($data);
      }
      

    }   


   // private function sendMessage($message, $recipients)
   //  {
   //      $account_sid = getenv("TWILIO_SID");
   //      $auth_token = getenv("TWILIO_AUTH_TOKEN");
   //      $twilio_number = getenv("TWILIO_NUMBER");
   //      $client = new Client($account_sid, $auth_token);
   //      $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
   //  }

    public function sendMessage($message, $recipients)
    {
        $receiverNumber =$recipients ;
        $message =$message ;
  
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            // dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            // dd("Error: ". $e->getMessage());
        }
    }


    // Capcha Code Image
    private function  code_image()
    {
        //         $actual_path = str_replace('project','',base_path('/'));
        // $image = imagecreatetruecolor(200, 50);
        // $background_color = imagecolorallocate($image, 255, 255, 255);
        // imagefilledrectangle($image,0,0,200,50,$background_color);

        // $pixel = imagecolorallocate($image, 0,0,255);
        // for($i=0;$i<500;$i++)
        // {
        //     imagesetpixel($image,rand()%200,rand()%50,$pixel);
        // }

        // $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        // $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        // $length = strlen($allowed_letters);
        // $letter = $allowed_letters[rand(0, $length-1)];
        // $word='';
        // //$text_color = imagecolorallocate($image, 8, 186, 239);
        // $text_color = imagecolorallocate($image, 0, 0, 0);
        // $cap_length=6;// No. of character in image
        // for ($i = 0; $i< $cap_length;$i++)
        // {
        //     $letter = $allowed_letters[rand(0, $length-1)];
        //     imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
        //     $word.=$letter;
        // }
        // $pixels = imagecolorallocate($image, 8, 186, 239);
        // for($i=0;$i<500;$i++)
        // {
        //     imagesetpixel($image,rand()%200,rand()%50,$pixels);
        // }
        // session(['captcha_string' => $word]);
        // imagepng($image, $actual_path."assets/images/capcha_code.png");
    }
    
}
