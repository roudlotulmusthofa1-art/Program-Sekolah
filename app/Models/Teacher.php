<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'kode',
        'teacher_name',
        'birth_place',
        'birth_date',
        'gender',
        'status',
        'whatsapp',
        'catatan',
        'email',
        'password',
        'photo',
        'user_id'
        ];

    protected $hidden = ['password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kelas-kelas dimana dia jadi wali kelas
    public function homeroomClasses()
    {
        return $this->hasMany(SchoolClass::class, 'wali_kelas_id');
    }

    // Kelas-kelas yang dia ajar (relasi ke absen & rapor nanti lewat pivot ini)
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'teacher_school_class')->withPivot('bidang_ilmu_id')->withTimestamps();
    }

    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->teacher_name));
        return collect($words)->take(2)->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
    }
}
