<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = new Admin();
        $teacher->name = 'teacher';
        $teacher->email = 'teacher@gmail.com';
        $teacher->admin_type = config('examapp.user_role.teacher');
        $teacher->slug = 'teacher';
        $teacher->password = Hash::make('password');
        $teacher->save();
    }
}
