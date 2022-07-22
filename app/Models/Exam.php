<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Exam extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'exams';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'title', 'status'
    ];
}
