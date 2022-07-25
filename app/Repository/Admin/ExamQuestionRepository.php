<?php

namespace App\Repository\Admin;

use App\Models\ExamQuestion;
use App\Models\Question;

class ExamQuestionRepository
{
    public function storeExamQuestion($data)
    {
        $question = Question::find($data->question_id);
        $examQuestion = new ExamQuestion;
        $examQuestion->exam_id = $data->exam_id;
        $examQuestion->question_id = $data->question_id;
        $examQuestion->question = $question->question;
        $examQuestion->answer_options = $question->answer_options;
        $examQuestion->status = config('examapp.exam_question_status.active');
        $examQuestion->score = $question->score;
        $examQuestion->question_type = $question->question_type;
        $examQuestion->question_image = $question->question_image;
        $examQuestion->save();
        return true;
    }

    public function deleteExamQuestion($data)
    {
        $examQuestion = ExamQuestion::find($data->id);
        $examQuestion->delete();
        return true;
    }
}