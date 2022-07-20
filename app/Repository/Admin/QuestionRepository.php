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

    public function storeQusetion($data)
    {
        $question = new Question();
        $image = "";
        if($data['form_type'] == 2) {
            $files = [$data['option_1_file'], $data['option_2_file'], $data['option_3_file'], $data['option_4_file']];
            $i = 1;
            foreach($files as $file) {
                $option = 'option_' . $i;
                $imageName = 'optionimage' . time().rand(0,1000) .'.' . $file->getClientOriginalExtension();
                $file->move(storage_path('/app/public/questions'), $imageName);
                
                $answerOptions[] = [
                    'answer_option_id'=>  $data['answer_option'], 'text' => "", 'image' => $imageName, 'is_correct_answer' => $data['answer_option'] == $option ? true : false,
                ];
                $i++;
            }
        } else {
            if($data->hasFile('question_file')) {
                $file = $data['question_file'];
                if($file) {
                    $image = 'optionimage' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $image);
                }
            }
            
            $answerOptions = [
                ['answer_option_id'=>  $data->answer_option, 'text' => $data['option_1'], 'image' => "", 'is_correct_answer' => $data['answer_option'] == 'option_1' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_2'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_2' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_3'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_3' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_4'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_4' ? true : false],
            ]; 
        }
        $question->question_image = $image;
        $question->question = $data['question'];
        $question->question_type = $data['form_type'];
        $question->score = $data['score'];
        $question->answer_options = $answerOptions;
        $question->save();
        return true;
    }

    public function updateQuestion($data)
    {
        $question = Question::find($data->question_id);
        $image = "";
        if($data['form_type'] == 2) {
            if($data->has('option_1_file')|| $data->has('option_2_file') || $data->has('option_3_file')|| $data->has('option_4_file')) {

                $files = [$data['option_1_file'], $data['option_2_file'], $data['option_3_file'], $data['option_4_file']];
                $i = 1;
                foreach($files as $file) {
                    $option = 'option_' . $i;
                    $imageName = 'optionimage' . time().rand(0,1000) .'.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $imageName);
                    $answerOptions[] = [
                        ['answer_option_id'=>  $data['answer_option'], 'text' => "", 'image' => $imageName, 'is_correct_answer' => $data['answer_option'] == $option ? true : false],
                    ];
                    $i++;
                }
            } else {
                
            }
            


        } else {
            if($data->hasFile('question_file')) {
                $file = $data['question_file'];
                if($file) {
                    $image = 'optionimage' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $image);
                }
                $question->question_image = $image;
            }

            $answerOptions = [
                ['answer_option_id'=>  $data->answer_option, 'text' => $data['option_1'], 'image' => "", 'is_correct_answer' => $data['answer_option'] == 'option_1' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_2'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_2' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_3'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_3' ? true : false],
                ['answer_option_id'=> $data->answer_option, 'text' => $data['option_4'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_4' ? true : false],
            ]; 
        }
        $question->question = $data->question; 
        $question->score = $data->score;  
        $question->question_type = $data['form_type'];
        $question->answer_options = $answerOptions;
        $question->save();
        return true;
    }

    public function deleteQuestion($data)
    {
        $question = Question::find($data->id);
        $question->delete();
        return true;
    }
}