<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('student')->delete();
        $student = new Student();
        $student->name = 'student';
        $student->email = 'student@gmail.com';
        $student->admin_type = config('examapp.user_role.student');
        $student->slug = 'student';
        $student->status = config('examapp.student_status.pending');
        $student->password= Hash::make('password');
        $student->save();
    }
}
