<?php

namespace App\Repository\Student;

use App\Models\Exam;

class ExamRepository
{
    public function getExamListData($data)
    {
        $draw = $data->draw;
        $search = $data->search['value'];
        $length = $data->length;
        $start = $data->start;
        // getting driver data
        $query = Exam::select('title','status');
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['title','status'];
            $query->where(function ($query) use ($searchColumns, $search) {
                foreach ($searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            $filteredCount = $query->count();
        } else {
            $filteredCount = $count;
        }
        $exams = $query->offset($start)->limit($length)->get();
        // creating action buttons

        foreach ($exams as $exam) {
            $exam['actions'] = '<a href="'.route('student.exam.show', $exam->_id).'"><button class="btn btn-success me-2" data-toggle="modal" data-target="" value=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-list" viewBox="0 0 16 16">
            <path d="M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z"/>
          </svg></button></a>';
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $exams];
    }

    public function attendExamQuestions($data)
    {
        dd($data->all());
    }
}