<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PendaftaranSiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran_siswa';

    protected $fillable = [
        'no_pendaftaran',
        // STEP 1 - DATA PRIBADI
        // =============================================
        'nama_lengkap',
        'nik',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'anak_ke',
        'jumlah_saudara',
        'alamat',
        'no_telepon',

        // =============================================
        // STEP 2 - DATA ORANG TUA
        // =============================================
        'father_name',
        'father_job',
        'father_email',
        'father_phone',
        'mother_name',
        'mother_job',
        'mother_email',
        'mother_phone',
        'parent_address',
        'income',

        // =============================================
        // STEP 3 - PENDIDIKAN
        // =============================================
        'school_name',
        'education_level',
        'graduation_year',
        'achievement',

        // =============================================
        // STEP 4 - KESEHATAN
        // =============================================
        'blood_type',
        'medical_history',
        'allergy',
        'special_condition',

        // =============================================
        // STEP 5 - KEAGAMAAN
        // =============================================
        'quran_reading_ability',
        'memorized_juz',
        'previous_pesantren',
        'religious_skill',

        // =============================================
        // STEP 6 - INFO LAINNYA
        // =============================================
        'hobby_talent',
        'extracurricular_interest',
        'future_goal',

        // =============================================
        // STEP 7 - DOKUMEN
        // =============================================
        'photo',
        'birth_certificate',
        'family_card',
        'certificate',

        // =============================================
        // STEP 8 - MOTIVASI
        // =============================================
        'alasan',

        // =============================================
        // STEP 9 - VERIFIKASI & STATUS
        // =============================================
        'agree_rules',
        'agree_payment',
        'agree_data_truth',
        'status',
        'last_step',
        'periode_psb',
        'catatan_admin',
        'kode_akses',
        'is_archived',
        'diterima_at',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'anak_ke' => 'integer',
        'jumlah_saudara' => 'integer',
        'memorized_juz' => 'integer',
        'agree_rules' => 'boolean',
        'agree_payment' => 'boolean',
        'agree_data_truth' => 'boolean',
        'last_step' => 'integer',
        'graduation_year' => 'integer',
        'tanggal_daftar' => 'date',
        'diterima_at' => 'datetime',
        'is_archived' => 'boolean',
    ];

    // =============================================
    // CONSTANTS
    // =============================================
    const STATUS_LABELS = [
        'pending' => 'Pending',
        'follow_up' => 'Perlu Follow-up',
        'dihubungi' => 'Dihubungi',
        'dalam_proses' => 'Dalam Proses',
        'diterima' => 'Diterima',
        'ditolak' => 'Ditolak',
       
    ];
    const STATUS_COLORS = [
        'pending' => 'yellow',
        'follow_up' => 'orange',
        'dihubungi' => 'blue',
        'dalam_proses' => 'purple',
        'diterima' => 'green',
        'ditolak' => 'red',
      
    ];

    const STATUS_SUBMITTED = 'pending';
    const STATUS_ACCEPTED = 'diterima';
    const STATUS_DRAFT = 'draft';
    
    const INCOME_OPTIONS = [
        '<1jt' => 'Kurang dari Rp 1.000.000',
        '1-3jt' => 'Rp 1.000.000 - Rp 3.000.000',
        '3-5jt' => 'Rp 3.000.000 - Rp 5.000.000',
        '5-10jt' => 'Rp 5.000.000 - Rp 10.000.000',
        '>10jt' => 'Lebih dari Rp 10.000.000',
    ];

    const QURAN_ABILITY_OPTIONS = [
        'belum_bisa' => 'Belum Bisa',
        'iqro' => "Iqro'",
        'terbata' => 'Bisa Membaca Terbata-bata',
        'lancar' => 'Lancar',
        'tartil' => 'Tartil',
    ];

    const EDUCATION_LEVELS = ['SD / MI', 'SMP / MTs', 'SMA / MA', 'SMK'];

    // =============================================
    // HELPER METHODS
    // =============================================

    /**
     * Cek apakah semua dokumen sudah diupload
     */
    public function isDocumentsComplete(): bool
    {
        return $this->photo && $this->birth_certificate && $this->family_card && $this->certificate;
    }

    /**
     * Hitung jumlah dokumen yang sudah diupload
     */
    public function countUploadedDocuments(): int
    {
        return collect([$this->photo, $this->birth_certificate, $this->family_card, $this->certificate])
            ->filter()
            ->count();
    }

    /**
     * Cek apakah semua pernyataan sudah disetujui
     */
    public function isAllAgreed(): bool
    {
        return $this->agree_rules && $this->agree_payment && $this->agree_data_truth;
    }

    /**
     * Cek apakah pendaftaran sudah selesai (step 9 selesai)
     */
    public function isCompleted(): bool
    {
        return $this->status !== self::STATUS_DRAFT;
    }

    /**
     * Label status dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    /**
     * Label jenis kelamin
     */
    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Label kemampuan baca quran
     */
    public function getQuranAbilityLabelAttribute(): string
    {
        return self::QURAN_ABILITY_OPTIONS[$this->quran_reading_ability] ?? '-';
    }

    /**
     * Label penghasilan
     */
    public function getIncomeLabelAttribute(): string
    {
        return self::INCOME_OPTIONS[$this->income] ?? '-';
    }

    /**
     * URL foto (menggunakan storage)
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'gray';
    }

    // =============================================
    // SCOPES
    // =============================================

    public function scopeSubmitted($query)
    {
        return $query->where('status', self::STATUS_SUBMITTED);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    // ─── Scopes ───────────────────────────────────────────────────
    public function scopeActive($q)
    {
        return $q->where('is_archived', false);
    }
    public function scopeArchived($q)
    {
        return $q->where('is_archived', true);
    }
    public function scopeStatus($q, $s)
    {
        return $q->where('status', $s);
    }

    // ─── Auto-generate nomor pendaftaran ─────────────────────────
    protected static function booted(): void
    {
        static::creating(function (PendaftaranSiswa $p) {
            if (empty($p->no_pendaftaran)) {
                $year = now()->year;
                $last = static::whereYear('created_at', $year)->max('id') ?? 0;
                $p->no_pendaftaran = 'PSB-' . $year . '-' . str_pad($last + 1, 5, '0', STR_PAD_LEFT);
            }
            if (empty($p->tanggal_daftar)) {
                $p->tanggal_daftar = Carbon::now();
            }
        });
    }

    // ─── Generate kode akses unik ─────────────────────────────────
    public static function generateKodeAkses(): string
    {
        do {
            $kode = strtoupper(Str::random(3)) . '-' . rand(1000, 9999);
        } while (static::where('kode_akses', $kode)->exists());

        return $kode;
    }

    // ─── Terima pendaftaran → buat Student ───────────────────────
   public function terima(?int $schoolClassId = null)
{
    $kodeAkses = $this->kode_akses ?: self::generateKodeAkses();

    // Cek apakah student sudah punya NIS (kalau updateOrCreate dipanggil ulang, jangan generate NIS baru)
    $existingStudent = Student::where('pendaftaran_id', $this->id)->first();
    $nis = $existingStudent->nis ?? Student::generateNis();

    $student = Student::updateOrCreate(
        [
            'pendaftaran_id' => $this->id,
        ],
        [
            'registration_code' => $kodeAkses,
            'guardian_id'       => $this->guardian_id ?? null,
            'nis'               => $nis,
            'name'              => $this->nama_lengkap,
            'birth_place'       => $this->tempat_lahir,
            'birth_date'        => $this->tanggal_lahir,
            'gender'            => $this->jenis_kelamin,
            'address'           => $this->alamat,
            'phone'             => $this->no_telepon,
            'school_class_id'   => $schoolClassId,
            'status'            => 'aktif',
            'entry_date'        => now(),
        ],
    );

    $this->update([
        'status'      => 'diterima',
        'kode_akses'  => $kodeAkses,
        'diterima_at' => now(),
    ]);

    return $student;
}

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'pendaftaran_id');
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }
}
