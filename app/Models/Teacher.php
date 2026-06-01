<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [

        'student_name',
        'birth_place',
        'birth_date',
        'gender',
        'whatsapp',
        'email',
        'password',

    ];

    protected $hidden = [
        'password',
    ];
}
