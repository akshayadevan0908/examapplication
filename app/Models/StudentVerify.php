<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class StudentVerify extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'students_verify';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'student_id', 'token'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
