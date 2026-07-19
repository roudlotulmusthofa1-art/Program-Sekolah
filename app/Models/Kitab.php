<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Kitab extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kitab',
        'slug',
        'deskripsi',
        'bidang_ilmu_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kitab) . '-' . Str::random(4);
            }
        });
    }

    // ── Relasi ───────────────────────────────────────────────────────────

    public function bidangIlmu(): BelongsTo
    {
        return $this->belongsTo(BidangIlmu::class, 'bidang_ilmu_id');
    }

    public function schoolClasses(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'kitab_school_class')
            ->withPivot('semester', 'frekuensi_per_minggu')
            ->withTimestamps();
    }

    // ── Scope ────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBidang($query, $bidangIlmuId)
    {
        return $query->where('bidang_ilmu_id', $bidangIlmuId);
    }

    // ── Accessor bantu tampilan (dipakai di card index) ──────────────────

    /**
     * Daftar semester unik yang dipakai kitab ini, contoh: "1, 2"
     * Butuh schoolClasses sudah di-eager-load supaya tidak N+1.
     */
    public function getSemesterListAttribute(): string
    {
        return $this->schoolClasses
            ->pluck('pivot.semester')
            ->unique()
            ->sort()
            ->implode(', ');
    }

    /**
     * Frekuensi tertinggi antar kelas, ditampilkan sebagai ringkasan card.
     * Kalau tiap kelas punya frekuensi sama ini otomatis sama juga.
     */
    public function getFrekuensiRingkasAttribute(): ?string
    {
        $max = $this->schoolClasses->pluck('pivot.frekuensi_per_minggu')->max();

        return $max ? "{$max}x/minggu" : null;
    }

    public function getJumlahKelasAttribute(): int
    {
        return $this->schoolClasses->pluck('id')->unique()->count();
    }
}