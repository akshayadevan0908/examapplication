<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $collection = 'admin';
    protected $connection = 'mongodb';
   
    protected $fillable = [
        'name', 'email','password'
    ];
}
