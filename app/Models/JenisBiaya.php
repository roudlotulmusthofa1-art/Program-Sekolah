<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBiaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function biayaPendidikan()
    {
        return $this->hasMany(BiayaPendidikan::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }
}
