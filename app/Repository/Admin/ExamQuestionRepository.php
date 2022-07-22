<?php

namespace App\Repository\Admin;

use App\Models\ExamQuestion;
use App\Models\Question;

class ExamQuestionRepository
{
    public function storeExamQuestion($data)
    {
        $question = Question::find($data->question_id);
        $examQuestion = ExamQuestion::create([
            'exam_id' => $data->exam_id,
            'question_id' => $data->question_id,
        ]);
        $examQuestion->question = $question->question;
        $examQuestion->answer_option= 1;
        foreach($question->answer_options as $key=>$option){
            $examQuestion->option_.$key = $option['text'];
        }
        $examQuestion->status = config('examapp.exam_question_status.active');
        $examQuestion->save();
        return true;
    }
}