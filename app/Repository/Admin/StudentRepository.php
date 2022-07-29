<?php

namespace App\Repository\Admin;

use App\Models\Student;

class StudentRepository
{
    public function getStudentList($data)
    {
        $draw = $data->draw;
        $search = $data->search['value'];
        $length = $data->length;
        $start = $data->start;
        // getting driver data
        $query = Student::select('name','email','status');
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['name', 'time', 'status'];
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
            $exam['actions'] = "<a href=''><button class='btn btn-success me-2' data-toggle='modal' data-target='' value=''><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-view-list' viewBox='0 0 16 16'>
            <path d='M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z'/>
          </svg></button></a>
            <button class='btn btn-danger deletebtn' value='$exam->_id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
          </svg></button>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $exams];
    }

}