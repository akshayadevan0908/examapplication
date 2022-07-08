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
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'score' => 'required',
            // 'option_a' => 'required|nullable',
            // 'option_b' => 'required|nullable',
            // 'option_c' => 'required|nullable',
            // 'option_d' => 'required|nullable',
            // 'option_a_file' => 'required',
            // 'option_b_file' => 'required',
            // 'option_c_file' => 'required',
            // 'option_d_file' => 'required',
            'answer_option' => 'required',
        ];
    }

    public function messages()
         {
             return [
                'answer_option.required' => 'Select one answer as option', 
             ];
         }
}
