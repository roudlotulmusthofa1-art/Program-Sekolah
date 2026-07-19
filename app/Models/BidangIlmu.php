<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BidangIlmu extends Model
{
    use HasFactory;

    protected $table = 'bidang_ilmu';

    protected $fillable = ['nama', 'slug', 'kode', 'deskripsi', 'warna', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-generate slug dari nama
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
            // Urutan otomatis jika tidak diset
            if (empty($model->urutan)) {
                $model->urutan = static::max('urutan') + 1;
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    // ── Relasi ───────────────────────────────────────────────────────────

    /**
     * Semua kitab yang berada di bidang ilmu (fann) ini.
     * Contoh: Nahwu -> Al-Miftah, Fawaid Nahwiyah, dll.
     */
    public function kitabs(): HasMany
    {
        return $this->hasMany(Kitab::class, 'bidang_ilmu_id');
    }
}
