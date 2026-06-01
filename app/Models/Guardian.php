<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['student_name', 'birth_place', 'birth_date', 'gender', 'program', 'guardian_name', 'whatsapp', 'email', 'information_source', 'password'];

    protected $hidden = ['password'];
}
