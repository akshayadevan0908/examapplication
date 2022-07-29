<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Question\QuestionController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Admin\Exam\ExamController;
use App\Http\Controllers\Admin\ExamQuestion\ExamQuestionController;
use App\Http\Controllers\Auth\AuthController as AuthAuthController;

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



//Student Auth Routes
Route::get('student/login', [AuthAuthController::class, 'index'])->name('student.login');
Route::post('student-login', [AuthAuthController::class, 'postLogin'])->name('login.post'); 
Route::get('student-logout', [AuthAuthController::class, 'logout'])->name('student.logout');
Route::get('registration', [AuthAuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthAuthController::class, 'postRegistration'])->name('register.post');

// Route::get('teacher/home', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');



//Admin Auth
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(["prefix" => "admin", "as" => 'admin.'], function () {

    Route::group(["prefix" => "student", "as" => 'student.'], function () {
        // Route::get('home', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('index', [StudentController::class, 'index'])->name('index');
        Route::get('create', [StudentController::class, 'create'])->name('create');

        Route::post('exam-list-table', [StudentController::class, 'getStudentList'])->name('exam-list-table');
    });

    Route::group(["prefix" => "question", "as" => 'question.'], function () {
        Route::get('index', [QuestionController::class, 'index'])->name('index');
        Route::get('create', [QuestionController::class, 'create'])->name('create');
        Route::post('store', [QuestionController::class, 'store'])->name('store');
        Route::get('edit/{question}', [QuestionController::class, 'edit'])->name('edit');
        Route::post('update', [QuestionController::class, 'update'])->name('update');

        Route::post('delete', [QuestionController::class, 'delete'])->name('delete');
        Route::post('get-details', [QuestionController::class, 'getDetails'])->name('get-details');
        
        Route::post('question-list-table', [QuestionController::class, 'getQuestionList'])->name('question-list-table');
        
    });

    Route::group(["prefix" => "teacher", "as" => 'teacher.'], function () {
        Route::get('index', [TeacherController::class, 'index'])->name('index');
        Route::get('create', [TeacherController::class, 'create'])->name('create');
        Route::get('edit/??', [TeacherController::class, 'edit'])->name('edit');
        Route::post('store', [TeacherController::class, 'store'])->name('store');
    });

    Route::group(["prefix" => "exam", "as" => 'exam.'], function () {
        Route::get('index', [ExamController::class, 'index'])->name('index');
        Route::get('create', [ExamController::class, 'create'])->name('create');
        Route::post('store', [ExamController::class, 'store'])->name('store');
        Route::post('status', [ExamController::class, 'status'])->name('status');
        Route::get('show/{exam}', [ExamController::class, 'show'])->name('show');
        Route::post('store-question-to-exam', [ExamController::class, 'storeQuestionToExam'])->name('store-question-to-exam');
        Route::post('delete', [ExamController::class, 'delete'])->name('delete');

        Route::post('update-exam-status', [ExamController::class, 'updateExamStatus'])->name('update-exam-status');
        
    });
    Route::group(["prefix" => "exam-question", "as" => 'exam-question.'], function () {
        Route::get('index', [ExamQuestionController::class, 'index'])->name('index');
        Route::get('edit/{examQuestion}', [ExamQuestionController::class, 'edit'])->name('edit');
        Route::get('create', [ExamQuestionController::class, 'create'])->name('create');
        Route::post('store', [ExamQuestionController::class, 'store'])->name('store');
        Route::post('delete', [ExamQuestionController::class, 'delete'])->name('delete');
    });
    
});

Route::group(["prefix" => "teacher", "as" => 'teacher.'], function () {
    Route::get('profile/view', [TeacherController::class, 'profile'])->name('profile.view');
    Route::post('profile/update', [TeacherController::class, 'updateProfile'])->name('profile.update');
});

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('student/dashboard', [AuthAuthController::class, 'dashboard'])->name('student.dashboard')->middleware(['is_verify_email']); 
Route::get('account/verify/{token}', [AuthAuthController::class, 'verifyAccount'])->name('user.verify'); 