<?php

namespace App\Repository\Admin;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class ExamRepository
{
    public function storeExam($data)
    {
        Exam::create([
            'title' => $data['title'],
            'status' => config('examapp.exam_status.active'),
        ]);
        return true;
    }

    public function examStatusChange($data)
    {
        $exam = Exam::find($data->id);
        $exam->status = $data->status;
        $exam->save();
        return true;
    }

}