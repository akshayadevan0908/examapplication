<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Models\Exam;
use App\Repository\Admin\ExamRepository;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }
    public function index()
    {
        $exams = Exam::get();
        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exam.create');
    }

    public function store(ExamStoreRequest $request)
    {
        try {
            $this->examRepository->storeExam($request);
            return response()->json([
                    'status' => true,
                    'message' => 'Exam Created Successfully',
                ]);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function status(Request $request)
    {
        try {
            $this->examRepository->examStatusChange($request);
            return response()->json([
                    'status' => true,
                    'message' => 'Exam Staus Updated Successfully',
                ]);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }


}