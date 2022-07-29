<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\Admin\StudentRepository;

class StudentController extends Controller
{
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function index()
    {
        $students = Student::get();
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function getStudentList(Request $request)
    {
        try {
            $students = $this->studentRepository->getStudentList($request);
            return response()->json(
                 $students);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}
