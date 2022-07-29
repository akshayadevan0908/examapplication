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
        if ($data['form_type'] == 2) {
            $files = [$data['option_1_file'], $data['option_2_file'], $data['option_3_file'], $data['option_4_file']];
            $i = 1;
            foreach ($files as $file) {
                $option = 'option_' . $i;
                $imageName = 'optionimage' . time() . rand(0, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('/app/public/questions'), $imageName);

                $answerOptions[] = [
                    'answer_option_id' =>  $data['answer_option'], 'text' => "", 'image' => $imageName, 'is_correct_answer' => $data['answer_option'] == $option ? true : false,
                ];
                $i++;
            }
        } else {
            if ($data->hasFile('question_file')) {
                $file = $data['question_file'];
                if ($file) {
                    $image = 'optionimage' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $image);
                }
            }

            $answerOptions = [
                ['answer_option_id' =>  $data->answer_option, 'text' => $data['option_1'], 'image' => "", 'is_correct_answer' => $data['answer_option'] == 'option_1' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_2'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_2' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_3'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_3' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_4'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_4' ? true : false],
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
        if ($data['form_type'] == 2) {
            $files = [$data['option_1_file'], $data['option_2_file'], $data['option_3_file'], $data['option_4_file']];
            $i = 1;
            foreach ($files as $key => $file) {
                $option = 'option_' . $i;
                if ($file) {
                    $imageName = 'optionimage' . time() . rand(0, 1000) . '.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $imageName);
                    $answerOptions[$key]['answer_option_id'] = $data['answer_option'];
                    $answerOptions[$key]['text'] = '';
                    $answerOptions[$key]['image'] = $imageName;
                    $answerOptions[$key]['is_correct_answer'] = $data['answer_option'] == $option ? true : false;
                } else {
                    $imageName = $question->answer_options[$key]['image'];
                    $answerOptions[$key]['answer_option_id'] = $data['answer_option'];
                    $answerOptions[$key]['text'] = '';
                    $answerOptions[$key]['image'] = $imageName;
                    $answerOptions[$key]['is_correct_answer'] = $data['answer_option'] == $option ? true : false;
                }
                $i++;
            }
        } else {
            if ($data->hasFile('question_file')) {
                $file = $data['question_file'];
                if ($file) {
                    $image = 'optionimage' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(storage_path('/app/public/questions'), $image);
                }
                $question->question_image = $image;
            }

            $answerOptions = [
                ['answer_option_id' =>  $data->answer_option, 'text' => $data['option_1'], 'image' => "", 'is_correct_answer' => $data['answer_option'] == 'option_1' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_2'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_2' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_3'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_3' ? true : false],
                ['answer_option_id' => $data->answer_option, 'text' => $data['option_4'], 'image' => "", 'is_correct_answer' =>  $data['answer_option'] == 'option_4' ? true : false],
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

    public function getQuestionDataList($data)
    {
        $draw = $data->draw;
        $search = $data->search['value'];
        $length = $data->length;
        $start = $data->start;
        // getting driver data
        $query = Question::select('question', 'question_type', 'score');
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['question', 'question_type', 'score'];
            $query->where(function ($query) use ($searchColumns, $search) {
                foreach ($searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            $filteredCount = $query->count();
        } else {
            $filteredCount = $count;
        }
        $questions = $query->offset($start)->limit($length)->get();
        // creating action buttons
        foreach ($questions as $question) {
            $question['editaction'] = '<a href="'.route('admin.question.edit', $question->_id).'" title="edit question">
                <button class="btn btn-success me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg></button>
                </a>';
                
            $question['deleteaction'] = "<a href='javascript:;' class='js_delete_question' data-id='$question->_id'><button class='btn btn-danger deletebtn' value='$question->_id'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
                </svg></button></a>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $questions];
    }
}
