<?php

return [
    'user_role' => [
        'admin'     =>  '1',
        'teacher'   =>  '2' ,
        'student'   =>  '3'
    ],

    'student_status' => [
        'approved'  =>  1,
        'pending'   =>  0,
        'rejected'  =>  2
    ],

    'question_type' => [
        'question_text_answer_text'  =>  1,
        'question_text_answer_image'  =>  2,
        'question_text_image_answer_text' => 3
    ],

    'exam_status' => [
        'active'   => 1,
        'inactive' => 0
    ],

    'exam_question_status' => [
        'active'   => 1,
        'inactive' => 0
    ]
];