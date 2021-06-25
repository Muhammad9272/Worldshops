<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Validator;
use Exception;
use Twilio\Rest\Client;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

	public function showRegisterForm($value='')
	{
		return view('front.register');
	}

    public function register(Request $request)
    {

    	

    	$gs = Generalsetting::findOrFail(1);
        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
    
	        $user = new User;
	        $input = $request->all();        
	        $input['password'] = bcrypt($request['password']);

	        $token_code=rand(11280,98500);
	        $authentication_link=md5(time().rand(116728,967850).$request->email);
	        $input['authentication_link'] = $authentication_link;
	        $input['authentication_code']=$token_code;
	        
	        $input['affilate_code'] = md5($request->name.$request->email);
	        $user->email_verified = 'Yes';
	        $user->login_count=$gs->verification_link_expire;

			  
			$user->fill($input)->save();
            
            $user=User::findOrFail($user->id);
	        if($user->is_authentication == 1)
	        {
              //Send Verification Code to phone number
              if($user->phone){
                $sphone=$user->phone;
                $msg="Dear Customer, Your Verfication code is " .$token_code;

                $this->sendMessage($msg,$sphone);
              }
              //Send Verification Code to phone number ends

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
		        $data[0]=$user->email;
		        $data[111]=route('resend-authentication-code',$request->email);
	          	return response()->json($data);
	        }
	        else {

            // $user->email_verified = 'Yes';
            // $user->update();
		        $notification = new Notification;
		        $notification->user_id = $user->id;
		        $notification->save();
	            Auth::guard('web')->login($user); 
	          	return response()->json(1);
	        }

    }

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


  //   public function generateNewtoken($email){
  //       $userdata = User::where('email','=',$email)->first();
  //       $token_code=rand(1128,9850);
  //        $gs = Generalsetting::findOrFail(1);
	 //    if($gs->is_verification_email == 1)
	 //        {
	 //        $to = $userdata->email;
	 //        $subject = 'Verify your email address.';
	 //        $msg = "Dear Customer,<br> We noticed that you need to verify your email address.This is your  Verification Code ".$token_code;
	 //        //Sending Email To Customer
		//         if($gs->is_smtp == 1)
		//         {
		// 	        $data = [
		// 	            'to' => $to,
		// 	            'subject' => $subject,
		// 	            'body' => $msg,
		// 	        ];

		// 	        $mailer = new GeniusMailer();
		// 	        $mailer->sendCustomMail($data);
		//         }
		//         else
		//         {
		//         $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
		//         mail($to,$subject,$msg,$headers);
		//         }

  //            $today = Carbon::now()->format('Y-m-d H:i:s');
	 //         $min=$gs->verification_link_expire;                     
	 //         $link_expire = date('Y-m-d H:i:s', strtotime($today.' + '.$min.' minutes'));
	 //         $userdata->verification_link_expire=$link_expire;
	 //         $userdata->verification_code=$token_code;
	 //         $userdata->update();
	 //         $today = Carbon::now()->format('Y-m-d H:i:s');                  
		//     $link_expire = date('Y-m-d H:i:s', strtotime($today));
	 //        return redirect()->route('user-register-token',$userdata->verification_link);
	 //     }
	 //     else{
	 //     	return redirect()->back();
	 //     }     
      
  //   }

  //   public function tokenPage($token){
  //   	$today = Carbon::now()->format('Y-m-d H:i:s');                  
	 //    $link_expire = date('Y-m-d H:i:s', strtotime($today));

  //     $userdata = User::where('verification_link','=',$token)->first();
      
  //     if($userdata->verification_link_expire>=$link_expire){
  //     	$checkverify=1;
  //     	return view('front.verify-email',compact('userdata','checkverify'));
  //     }
  //     else{
  //     	$checkverify=0;

  //     	 return view('front.verify-email',compact('userdata','checkverify'));
  //     }
      
  //   }

  //   public function token(Request $request)
  //   {
  //       $gs = Generalsetting::findOrFail(1);

  //       if($gs->is_verification_email == 1)
	 //        {    	
  //       $user = User::where('verification_code','=',$request->token_code)->where('email',$request->email)->first();
  //       if(isset($user))
  //       {
  //           $user->email_verified = 'Yes';
  //           $user->update();
	 //        $notification = new Notification;
	 //        $notification->user_id = $user->id;
	 //        $notification->save();
  //           Auth::guard('web')->login($user); 
  //           $data[0]=route('user-dashboard');
  //           $data[1]=2;
  //           return response()->json($data);
  //       }
  //       else {
	 //        $msg="Invalid Code";
  //         	return response()->json($msg);
		// }
  //   		}
		
  //   }
}