<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardian extends Model
{
     use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['user_id', 'guardian_name', 'whatsapp', 'email', 'adress'];

    // protected $hidden = ['password'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
