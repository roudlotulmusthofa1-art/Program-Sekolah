<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    protected $fillable = ['name', 'teacher_id'];
}
