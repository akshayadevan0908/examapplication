<?php

namespace App\Http\Controllers\Admin\ExamQuestion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamQuestion\ExamQuestionStoreRequest;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Repository\Admin\ExamQuestionRepository;

class ExamQuestionController extends Controller
{
    public function __construct(ExamQuestionRepository $examQuestionRepository)
    {
        $this->examQuestionRepository = $examQuestionRepository;
    }
    public function create()
    {
        $exams = Exam::get();
        $questions = Question::get();
        return view('admin.exam-question.create', compact('exams', 'questions'));
    }

    public function index()
    {
        $examQuestions = ExamQuestion::get();
        return view('admin.exam-question.index', compact('examQuestions'));
    }

    public function store(ExamQuestionStoreRequest $request)
    {
        try {
        $this->examQuestionRepository->storeExamQuestion($request);
            return response()->json([
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
            $this->examQuestionRepository->deleteExamQuestion($request);
                return response()->json([
                        'status' => true,
                        'message' => 'Deleted Successfully',
                    ]);
            } catch (Exception $e) {
                logger()->error($e);
                return false;
            }
    }

    public function edit(ExamQuestion $examQuestion)
    {
        $examQuestion = ExamQuestion::find($examQuestion->_id);
        return view('admin.exam-question.edit', compact('examQuestion'));
    }
}
