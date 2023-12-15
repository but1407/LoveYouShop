<?php 

namespace App\Services;

use App\Models\User; 
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\UserVerification;



class LoginService
{
    
    public  function __construct(){
       

    }

    public function postForgotPass($request){
        try {

            $request->validate([
                'email'=>'required|exists:users'
            ],[
                'email.exists'=>"This email is not exists on our database"
            ]);
            $token = strtoupper(Str::random(100));
            $customer = User::where('email',$request->email)->first();
            $customer->update(['token' => $token]);
            Mail::send('admin.users.mails.check_email_forgot',
            compact('customer'), function ($email) use ($customer) {
                $email->subject('My Account- Lay lai mat khau');
                $email->to($customer->email,$customer->name);
            });
            return $customer;
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());

            return false;
        }
        
    }
    
            
}
    