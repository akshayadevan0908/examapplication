<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *
     * @return array
     */
    public function rules()
    {
        $questionType = $this->form_type;

        //Question Text Answer Text
        if ($questionType == 1) {
            $rule = [
                'question'      => 'required',
                'score'         => 'required',
                'answer_option' => 'required',
                'question_type' => 'required',
            ];

        //Question Text Answer Image
        } else if($questionType == 2) {
            $rule = [
                'question'      => 'required',
                'score'         => 'required',
                'answer_option' => 'required',
                'question_type' => 'required',
                'option_1_file' => ['required','mimes:png,jpg,jpeg,pdf,doc,docx,txt,csv,xlsx,xls|max:100000'],
                'option_2_file' => ['required','mimes:png,jpg,jpeg,pdf,doc,docx,txt,csv,xlsx,xls|max:100000'],
                'option_3_file' => ['required','mimes:png,jpg,jpeg,pdf,doc,docx,txt,csv,xlsx,xls|max:100000'],
                'option_4_file' => ['required','mimes:png,jpg,jpeg,pdf,doc,docx,txt,csv,xlsx,xls|max:100000']
            ];

        //Question Text Image Answer Text
        }else if($questionType == 3) {
            $rule = [
                'question'      => 'required',
                'score'         => 'required',
                'answer_option' => 'required',
                'question_type' => 'required',
                'question_file' => 'required',
                'question_file' => ['required','mimes:png,jpg,jpeg,pdf,doc,docx,txt,csv,xlsx,xls|max:100000']
            ];
        }

        return  $rule;
    }

    public function messages()
         {
             return [
                'answer_option.required' => 'Select one answer as option', 
                'question_type.required' => 'Please select question type', 
             ];
         }
}
