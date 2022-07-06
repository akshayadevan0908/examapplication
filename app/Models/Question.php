<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Question extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'questions';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'question', 'answer_option', 'option_a', 'option_b', 'option_c', 'option_d', 'score', 'exam_type'
    ];
}
