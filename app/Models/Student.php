<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'student';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'name', 'email', 'admin_type', 'slug', 'status', 'password', 'is_email_verified'
    ];
}
