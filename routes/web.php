<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//New Routes
Route::get('student/login', [AuthAuthController::class, 'index'])->name('student.login');

Route::get('registration', [AuthAuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthAuthController::class, 'postRegistration'])->name('register.post');

Route::get('dashboard', [AuthAuthController::class, 'dashboard'])->middleware(['is_verify_email']); 
Route::get('account/verify/{token}', [AuthAuthController::class, 'verifyAccount'])->name('user.verify'); 