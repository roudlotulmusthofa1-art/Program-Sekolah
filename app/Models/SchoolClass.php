<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'slug', 'kategori', 'color', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kelas);
            }
            if (empty($model->order)) {
                $model->order = static::max('order') + 1;
            }
        });
    }

    // ── Relasi ───────────────────────────────────────────────────────────

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }

    public function getJumlahSantriAttribute(): int
    {
        return $this->students()->count();
    }

    public function waliKelas()
    {
        return $this->belongsTo(Teacher::class, 'wali_kelas_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_school_class')->withPivot('bidang_ilmu_id')->withTimestamps();
    }

    /**
     * Semua kitab yang diajarkan di kelas ini, lengkap dengan
     * semester & frekuensi/minggu masing-masing (lihat pivot).
     */
    public function kitabs(): BelongsToMany
    {
        return $this->belongsToMany(Kitab::class, 'kitab_school_class')->withPivot('semester', 'frekuensi_per_minggu')->withTimestamps();
    }

    // ── Scope: hanya kelas aktif, urut by order ───────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public static function daftarKategori(): array
    {
        return ['Akademik', 'Tahfidz', 'Takhassus', 'Lainnya'];
    }

    // ── Data default 11 kelas ─────────────────────────────────────────────
    public static function defaultClasses(): array
    {
        return [['name' => 'Tamhidi', 'slug' => 'tamhidi', 'color' => '#3b82f6', 'order' => 1], ['name' => 'Ibtida 1', 'slug' => 'ibtida-1', 'color' => '#22c55e', 'order' => 2], ['name' => 'Ibtida 2', 'slug' => 'ibtida-2', 'color' => '#eab308', 'order' => 3], ['name' => 'Tsanawiyah 1', 'slug' => 'tsanawiyah-1', 'color' => '#a855f7', 'order' => 4], ['name' => 'Tsanawiyah 2', 'slug' => 'tsanawiyah-2', 'color' => '#ef4444', 'order' => 5], ['name' => 'Tahfidz 1', 'slug' => 'tahfidz-1', 'color' => '#14b8a6', 'order' => 6], ['name' => 'Tahfidz 2', 'slug' => 'tahfidz-2', 'color' => '#0f766e', 'order' => 7], ['name' => 'Tahfidz 3', 'slug' => 'tahfidz-3', 'color' => '#0d5a52', 'order' => 8], ['name' => 'Takhassus 1', 'slug' => 'takhassus-1', 'color' => '#f59e0b', 'order' => 9], ['name' => 'Takhassus 2', 'slug' => 'takhassus-2', 'color' => '#f97316', 'order' => 10], ['name' => 'Takhassus 3', 'slug' => 'takhassus-3', 'color' => '#b45309', 'order' => 11]];
    }
}
