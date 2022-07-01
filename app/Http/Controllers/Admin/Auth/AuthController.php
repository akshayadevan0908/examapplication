<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Student\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
       
        if(Auth::guard('admin')->attempt($request->only('email', 'password'))) {

            if(Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin')) {

                return redirect()->route('admin.dashboard');
                
            } elseif (Auth::guard('admin')->user()->admin_type == config('examapp.user_role.teacher')) {
                
                return redirect()->route('teacher.dashboard');
                
            } 
        } elseif(Auth::guard('student')->attempt($request->only('email', 'password'))) {

            return redirect()->route('student.dashboard');

        }
        else {

            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request, Student $student)
    {
        $input = $request->all();
        $input['admin_type'] = config('examapp.user_role.student');
        $input['slug'] = 'student';
        $input['status'] = config('examapp.student_status.pending');
        $input['password'] = Hash::make($request->password);
        $studentInput = Arr::only($input, $student->getFillable());
        $student = Student::create($studentInput);
        Auth::guard('stduent')->login($student);
        return redirect()->route('student.dashboard');
    }
}
