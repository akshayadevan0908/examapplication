<?php

namespace App\Repository\Admin;

use App\Models\Question;
use Illuminate\Support\Arr;


class QuestionRepository
{
    public function __construct(Question $question)
    {
        $this->model = $question;
    }

    public function storeQusetion($request)
    {
        $question = new Question();
        if($request['form_type'] == 3) {

            $answerOptions = 3;

        } else if($request['form_type'] == 2){
            
            $answerOptions = 2;

        }else {
            $answerOptions[] = [
                ['text' => $request['option_a'], 'image' => "", 'is_correct_answer' => $request['answer_option'] ? true : false],
                ['text' => $request['option_b'], 'image' => "", 'is_correct_answer' => $request['answer_option'] ? true : false],
                ['text' => $request['option_c'], 'image' => "", 'is_correct_answer' => $request['answer_option'] ? true : false],
                ['text' => $request['option_d'], 'image' => "", 'is_correct_answer' => $request['answer_option'] ? true : false],
            ]; 
        }
        dd($answerOptions);
        $question->question = $request->question;
        $question->question_type = $request->form_type;
        $question->score = $request->score;
        $question->save();
        return true;
    }
}