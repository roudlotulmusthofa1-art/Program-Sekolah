<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClass extends Model
{
     use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Relasi ───────────────────────────────────────────────────────────
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }

    // ── Scope: hanya kelas aktif, urut by order ───────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    // ── Data default 11 kelas ─────────────────────────────────────────────
    public static function defaultClasses(): array
    {
        return [
            ['name' => 'Tamhidi',      'slug' => 'tamhidi',      'color' => '#3b82f6', 'order' => 1],
            ['name' => 'Ibtida 1',     'slug' => 'ibtida-1',     'color' => '#22c55e', 'order' => 2],
            ['name' => 'Ibtida 2',     'slug' => 'ibtida-2',     'color' => '#eab308', 'order' => 3],
            ['name' => 'Tsanawiyah 1', 'slug' => 'tsanawiyah-1', 'color' => '#a855f7', 'order' => 4],
            ['name' => 'Tsanawiyah 2', 'slug' => 'tsanawiyah-2', 'color' => '#ef4444', 'order' => 5],
            ['name' => 'Tahfidz 1',    'slug' => 'tahfidz-1',    'color' => '#14b8a6', 'order' => 6],
            ['name' => 'Tahfidz 2',    'slug' => 'tahfidz-2',    'color' => '#0f766e', 'order' => 7],
            ['name' => 'Tahfidz 3',    'slug' => 'tahfidz-3',    'color' => '#0d5a52', 'order' => 8],
            ['name' => 'Takhassus 1',  'slug' => 'takhassus-1',  'color' => '#f59e0b', 'order' => 9],
            ['name' => 'Takhassus 2',  'slug' => 'takhassus-2',  'color' => '#f97316', 'order' => 10],
            ['name' => 'Takhassus 3',  'slug' => 'takhassus-3',  'color' => '#b45309', 'order' => 11],
        ];
    }
}