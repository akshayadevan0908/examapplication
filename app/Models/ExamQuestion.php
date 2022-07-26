<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ExamQuestion extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'examquestions';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'exam_id', 'question_id', 'question', 'answer_option', 'option_a','option_b','option_c', 'option_d', 'status'
    ];

    public function getExam()
    {
        return $this->belongsTo(Exam::class,'_id','exam_id');
    }

    // public function question()
    // {
    //     return $this->belongsTo(Question::class,'question_id');
    // }
}
