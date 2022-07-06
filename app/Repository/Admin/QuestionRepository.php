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
        $questionInput = Arr::only($request, $this->model->getFillable());
        $this->model->create($questionInput);
        return true;
    }
}