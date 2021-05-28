<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use App\Mail\SendPasswordRest;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function submitForgetPasswordForm()
    {
        request()->validate([
            'email' => 'required|email|exists:users',
        ]);
        
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => Request::get('email'), 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        
        $name = User::where('email',Request::get('email'))->first('name'); 

        $url = url('/resetpassword/'.$token);

        $maildata = [
            'title' => 'Password Rest',
            'name' => $name['name'],
            'url' => $url
        ];

        Mail::to(Request::get('email'))->send(new SendPasswordRest($maildata));

        return Redirect::back()->with('success', 'We have e-mailed your password reset link!');   
    }

    public function showResetPasswordForm($token) { 

        return Inertia::render('Auth/ForgotPasswordLink',[
            'token' => $token
        ]);
        
    }

    public function submitResetPasswordForm()
      {
        
           
        request()->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required'
        ]);
        
        $updatePassword = DB::select('SELECT * FROM password_resets WHERE email = :email AND  token = :token',['email' => Request::get('email') ,'token' => Request::get('token') ]);
              
        if(!$updatePassword){
            return Redirect::back()->with('error', 'Invalid token!');
        }
  
        $user = User::where('email', Request::get('email'))
                    ->update(['password' => Hash::make(Request::get('password'))]);
 
        DB::table('password_resets')->where(['email'=> Request::get('email')])->delete();
  
        return Redirect::route('login')->with('success', 'Your password has been changed!');
      }


}
