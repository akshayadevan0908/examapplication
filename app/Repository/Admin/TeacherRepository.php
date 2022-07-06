<?php

namespace App\Repository\Admin;

use Illuminate\Support\Arr;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class TeacherRepository
{

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function storeTeacher($request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $input['admin_type'] = config('examapp.user_role.teacher');
        $input['slug'] = 'teacher';
        $teacherInput = Arr::only($input, $this->model->getFillable());
        $this->model->create($teacherInput);
        return true;
    }
}
