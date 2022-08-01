<?php

namespace App\Http\Controllers\Student;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\AttendExamRequest;
use App\Models\ExamQuestion;
use App\Repository\Student\ExamRepository;

class ExamController extends Controller
{
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }
    public function index()
    {
        return view('student.exam.index');
    }

    public function getExamList(Request $request)
    {
        try {
            $exams = $this->examRepository->getExamListData($request);
            return response()->json(
                 $exams);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function show($examId)
    {
        $questions = ExamQuestion::where('exam_id', $examId)->get();
        return view('student.exam.show', compact('questions'));
    }

    public function attendExam(AttendExamRequest $request)
    {
        try {
            $exams = $this->examRepository->attendExamQuestions($request);
            return response()->json(
                 $exams);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}
