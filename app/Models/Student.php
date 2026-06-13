<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['registration_code', 'pendaftaran_id', 'school_class_id', 'guardian_id', 'nis', 'name', 'birth_place', 'birth_date', 'gender', 'address', 'phone', 'photo', 'entry_date', 'exit_date', 'status', 'has_fee_scheme'];

    protected $casts = [
        'birth_date' => 'date',
        'entry_date' => 'date',
        'exit_date' => 'date',
        'has_fee_scheme' => 'boolean',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranSiswa::class, 'pendaftaran_id');
    }

    // ── Accessor: URL foto (pakai default jika kosong) ────────────────────
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-avatar.png');
    }

    // ── Scope: filter status aktif ────────────────────────────────────────
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // ── Scope: pencarian nama, tempat lahir, alamat ───────────────────────
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('birth_place', 'like', "%{$keyword}%")
                ->orWhere('address', 'like', "%{$keyword}%")
                ->orWhere('nis', 'like', "%{$keyword}%");
        });
    }
}
