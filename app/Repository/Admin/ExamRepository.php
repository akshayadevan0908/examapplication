<?php

namespace App\Repository\Admin;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ExamRepository
{
    public function storeExam($data)
    {
        $exam = Exam::create([
            'title' => $data['title'],
            'status' => config('examapp.exam_status.active'),
        ]);
        return $exam;
    }

    public function examStatusChange($data)
    {
        $exam = Exam::find($data->id);
        $exam->status = $data->status;
        $exam->save();
        return true;
    }

    public function storeExamQuestion($data)
    {
        $question = Question::find($data->question_id);
        $examQuestion = new ExamQuestion();
        $examQuestion->exam_id = $data->exam_id;
        $examQuestion->question_id = $data->question_id;
        $examQuestion->question = $question->question;
        $examQuestion->answer_options = $question->answer_options;
        $examQuestion->status = config('examapp.exam_question_status.active');
        $examQuestion->score = $question->score;
        $examQuestion->question_type = $question->question_type;
        $examQuestion->question_image = $question->question_image;
        $examQuestion->status = 1;
        $examQuestion->save();
        return $examQuestion;
    }

}