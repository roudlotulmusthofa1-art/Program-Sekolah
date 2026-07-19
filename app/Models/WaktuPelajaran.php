<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaktuPelajaran extends Model
{
    use HasFactory;

    protected $table = 'waktu_pelajaran';

    protected $fillable = ['nama', 'kode', 'jenis', 'jam_mulai', 'jam_selesai', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'jam_mulai' => 'string',
        'jam_selesai' => 'string',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->urutan)) {
                $model->urutan = static::max('urutan') + 1;
            }
        });
    }

    // Accessor: "07:00 – 08:00"
    public function getRentangWaktuAttribute(): string
    {
        return "{$this->jam_mulai} – {$this->jam_selesai}";
    }

    public function getLabelJenisAttribute(): string
    {
        return match ($this->jenis) {
            'sholat' => 'Sholat',
            'jam_tetap' => 'Jam Tetap',
            default => 'Lainnya',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
