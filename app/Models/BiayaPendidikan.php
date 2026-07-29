<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\JenisBiaya;

class BiayaPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_ajaran_id',
        'jenis_biaya_id',
        'nominal',
        'frekuensi'
    ];

    protected $casts = [
        'nominal' => 'integer',
    ];

    // relasi  ke tahun ajaran
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    // relasi ke jenis biaya 
    public function jenisBiaya(): BelongsTo
    {
        return $this->belongsTo(JenisBiaya::class, 'jenis_biaya_id');
    }
}
