<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mail; 


class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    } 

    public function registration()
    {
        return view('auth.registration');
    } 

    public function postRegistration(LoginRequest $request)
    {
        $data = $request->all();
        $createUser = $this->create($data);
        
        $token = Str::random(64);

        $data = StudentVerify::create([
              'student_id' => $createUser->id, 
              'token' => $token
            ]);
  
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function create(array $data)
    {
      return Student::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        // dd(Auth::guard('student')->check());
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function verifyAccount($token)
    {
        $verifyUser = StudentVerify::with('student')->where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->student;
              
            if(!$user->is_email_verified) {
                $verifyUser->student->is_email_verified = 'verified';
                $verifyUser->student->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
    }
}
