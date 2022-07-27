<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
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
            $result = $this->examRepository->storeExam($request);
            return redirect()->route('admin.exam.show', $result->_id);
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

    public function show(Exam $exam)
    {
        if($exam->status  == 1) {
            $exams = Exam::get();
            $questions = Question::get();
            $examQuestions = ExamQuestion::where('exam_id', $exam->_id)->get();
            $questions = Question::get();
            $questionIds = ExamQuestion::where('exam_id', $exam->_id)->pluck('question_id')->toArray();
            return view('admin.exam.show', compact('exam', 'exams', 'questions', 'examQuestions', 'questionIds'));
        } else {
            abort(404);
        }
    }

    public function storeQuestionToExam(Request $request)
    {
        try {
            $result = $this->examRepository->storeExamQuestion($request);
                return response()->json([
                    'data' => $result,
                        'status' => true,
                        'message' => 'Success',
                    ]);
            } catch (Exception $e) {
                logger()->error($e);
                return false;
            }
    }

    public function delete(Request $request)
    {
        try {
            $this->examRepository->deleteExamQuestion($request);
                return response()->json([
                        'status' => true,
                        'message' => 'Deleted Successfully',
                    ]);
            } catch (Exception $e) {
                logger()->error($e);
                return false;
            }
    }


}