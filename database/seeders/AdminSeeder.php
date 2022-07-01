<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('admin')->delete();
        $admin = new Admin();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->admin_type = config('examapp.user_role.admin');
        $admin->slug = 'admin';
        $admin->password = Hash::make('password');
        $admin->save();
    }
}
