<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\TeacherStoreRequest;
use App\Http\Requests\TeacherProfileUpdateRequest;
use App\Models\Admin;
use App\Repository\Admin\TeacherRepository;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
class TeacherController extends Controller
{
    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }
    public function index()
    {
        $teachers = Admin::where('admin_type', config('examapp.user_role.teacher'))->orderbydesc('created_at')->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teacher.create');
    }

    public function store(TeacherStoreRequest $request)
    {
        try {
            $this->teacherRepository->storeTeacher($request);
            return response()->json([
                    'status' => true,
                    'message' => 'Teacher Added Successfully',
                ]);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function profile()
    {
        if(Auth::guard('admin')->user()->admin_type == config('examapp.user_role.teacher')) {
            $teacher = Auth::guard('admin')->user();
        }
        return view('teacher.profile', compact('teacher'));
    }

    public function updateProfile(TeacherProfileUpdateRequest $request)
    {
        try {
            $this->teacherRepository->updateProfile($request);
            return response()->json([
                    'status' => true,
                    'message' => 'Profile Updated Successfully',
                ]);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}
