<?php

namespace App\Http\Controllers\Admin\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\QuestionStoreRequest;
use App\Models\Question;
use App\Repository\Admin\QuestionRepository;

class QuestionController extends Controller
{
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function create()
    {
        return view('admin.question.create');
    }

    public function index()
    {
        $questions = Question::orderbydesc('created_at')->get();
        return view('admin.question.index', compact('questions'));
    }

    public function store(QuestionStoreRequest $request)
    {
        try {
            $this->questionRepository->storeQusetion($request->all());
            return response()->json([
                    'status' => true,
                    'message' => 'Success',
                ]);
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function edit(Question $question)
    {
        $question = Question::find($question->_id);
        return view('admin.question.edit', compact('question'));
    }

    public function update(Request $request)
    {
        Question::update([
            'question' => $request->question
        ]);
    }
}

