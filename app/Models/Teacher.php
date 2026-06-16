<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [

        'teacher_name',
        'birth_place',
        'birth_date',
        'gender',
        'status',
        'whatsapp',
        'email',
        'password',

    ];

    protected $hidden = [
        'password',
    ];
}
