<?php

namespace App\Http\Controllers\User;

use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Password;
use DB; 
use Carbon\Carbon;
use Hash;
use Auth;


class ForgotController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForgotForm()
    {
      return view('front.forgot-password');
    }

    public function forgot(Request $request)
    {

      $gs = Generalsetting::findOrFail(1);
      $input =  $request->all();
      if (User::where('email', '=', $request->email)->count() > 0) {
      // user found
          $admin = User::where('email', '=', $request->email)->firstOrFail();
          $autopass = str_random(64);
          DB::table('password_resets')->insert(
                    ['email' => $request->email, 'token' => $autopass, 'created_at' => Carbon::now()]
                );

            $subject = "Reset Password Request";
            // $msg = "To Reset Your Password Click here: <a href=".route('user-password-rreset',$autopass).">Click Here</a>. " ;
            $msg=$autopass;
            if($gs->is_smtp == 1)
            {
                $data = [
                        'to' => $request->email,
                        'subject' => $subject,
                        'body' => $msg,                      
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);                
            }
            else
            {
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($request->email,$subject,$msg,$headers);            
            }
        return response()->json('We have e-mailed your password reset link!');
      }
      else{
      // user not found
      return response()->json(array('errors' => [ 0 => 'No Account Found With This Email.' ]));    
      }  


    }



   public function getPassword($token) { 

       $user = DB::table('password_resets')
                        ->where('token',$token)
                        ->first();
    if($user){
     return view('front.reset-password', ['token' => $token,'email'=>$user->email]);
    }
    else{
      return view('front.404');
    }

   }

    public function updatePassword(Request $request)
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

        $updatePassword = DB::table('password_resets')
                        ->where(['email' => $request->email, 'token' => $request->token])
                        ->first();

      if(!$updatePassword){
        return response()->json(array('errors' => [ 0 => 'Invalid token!' ]));
      }
      else{
          $user = User::where('email', $request->email)->first();
          $user->password=Hash::make($request->password);
          $user->update();          

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

         Auth::guard('web')->login($user); 

        $data[0]=1;
        $data[1]=route('user-dashboard');
        $data[2]="Your password has been changed!";
        return response()->json($data);
      }
      

    }



}
