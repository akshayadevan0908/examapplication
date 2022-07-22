<?php

namespace App\Repository\Admin;

use App\Jobs\SendNotificationToTeacherJob;
use Illuminate\Support\Arr;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Auth;


class TeacherRepository
{

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function storeTeacher($request)
    {
        // $encrypted = Hash::make(Str::random(8));
        // $decrypted = Crypt::decryptString($encrypted);
        $password = Hash::make($request->password);
        $input = $request->all();
        $input['password'] = $password;
        $input['admin_type'] = config('examapp.user_role.teacher');
        $input['slug'] = 'teacher';
        $teacherInput = Arr::only($input, $this->model->getFillable());
        $teacher = $this->model->create($teacherInput);
        dispatch(new SendNotificationToTeacherJob($teacher));
        return true;
    }

    public function updateProfile($data)
    {
        $user = Auth::guard('admin')->user();
        if (!$user) {
            return false;
        }
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
