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

            $files = [$request['option_a_file'], $request['option_b_file'], $request['option_c_file'], $request['option_d_file']];
            $i = 1;
            foreach($files as $file) {
                $option = 'option_' . $i;
                $imageName = 'optionimage' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('public/images'), $imageName);

                $answerOptions[] = [
                    ['answer_option_id'=>  $request['answer_option'], 'text' => "", 'image' => $imageName, 'is_correct_answer' => $request['answer_option'] == $option ? true : false],
                ];
                $i++;
            }

        }else {
            $answerOptions = [
                ['answer_option_id'=>  'option_a', 'text' => $request['option_a'], 'image' => "", 'is_correct_answer' => $request['answer_option'] == 'option_a' ? true : false],
                ['answer_option_id'=> 'option_b', 'text' => $request['option_b'], 'image' => "", 'is_correct_answer' =>  $request['answer_option'] == 'option_b' ? true : false],
                ['answer_option_id'=> 'option_c', 'text' => $request['option_c'], 'image' => "", 'is_correct_answer' =>  $request['answer_option'] == 'option_c' ? true : false],
                ['answer_option_id'=> 'option_d', 'text' => $request['option_d'], 'image' => "", 'is_correct_answer' =>  $request['answer_option'] == 'option_d' ? true : false],
            ]; 
        }
        // dd($answerOptions);
        $question->question = $request['question'];
        $question->question_type = $request['form_type'];
        $question->score = $request['score'];
        $question->answer_options = $answerOptions;
        $question->save();
        return true;
    }
}