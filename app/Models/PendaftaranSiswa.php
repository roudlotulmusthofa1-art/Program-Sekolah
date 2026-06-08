<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranSiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran_siswa';

    protected $fillable = [
        // =============================================
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
    ];

    protected $casts = [
        'tanggal_lahir'   => 'date',
        'anak_ke'         => 'integer',
        'jumlah_saudara'  => 'integer',
        'memorized_juz'   => 'integer',
        'agree_rules'     => 'boolean',
        'agree_payment'   => 'boolean',
        'agree_data_truth'=> 'boolean',
        'last_step'       => 'integer',
        'graduation_year' => 'integer',
    ];

    // =============================================
    // CONSTANTS
    // =============================================

    const STATUS_DRAFT     = 'draft';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_REVIEWED  = 'reviewed';
    const STATUS_ACCEPTED  = 'accepted';
    const STATUS_REJECTED  = 'rejected';

    const INCOME_OPTIONS = [
        '<1jt'   => 'Kurang dari Rp 1.000.000',
        '1-3jt'  => 'Rp 1.000.000 - Rp 3.000.000',
        '3-5jt'  => 'Rp 3.000.000 - Rp 5.000.000',
        '5-10jt' => 'Rp 5.000.000 - Rp 10.000.000',
        '>10jt'  => 'Lebih dari Rp 10.000.000',
    ];

    const QURAN_ABILITY_OPTIONS = [
        'belum_bisa' => 'Belum Bisa',
        'iqro'       => "Iqro'",
        'terbata'    => 'Bisa Membaca Terbata-bata',
        'lancar'     => 'Lancar',
        'tartil'     => 'Tartil',
    ];

    const EDUCATION_LEVELS = [
        'SD / MI',
        'SMP / MTs',
        'SMA / MA',
        'SMK',
    ];

    // =============================================
    // HELPER METHODS
    // =============================================

    /**
     * Cek apakah semua dokumen sudah diupload
     */
    public function isDocumentsComplete(): bool
    {
        return $this->photo
            && $this->birth_certificate
            && $this->family_card
            && $this->certificate;
    }

    /**
     * Hitung jumlah dokumen yang sudah diupload
     */
    public function countUploadedDocuments(): int
    {
        return collect([
            $this->photo,
            $this->birth_certificate,
            $this->family_card,
            $this->certificate,
        ])->filter()->count();
    }

    /**
     * Cek apakah semua pernyataan sudah disetujui
     */
    public function isAllAgreed(): bool
    {
        return $this->agree_rules
            && $this->agree_payment
            && $this->agree_data_truth;
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
        return match ($this->status) {
            self::STATUS_DRAFT     => 'Draft',
            self::STATUS_SUBMITTED => 'Menunggu Review',
            self::STATUS_REVIEWED  => 'Sedang Diproses',
            self::STATUS_ACCEPTED  => 'Diterima',
            self::STATUS_REJECTED  => 'Ditolak',
            default                => 'Tidak Diketahui',
        };
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
        return $this->photo
            ? asset('storage/' . $this->photo)
            : null;
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

    public function student()
{
    return $this->hasOne(Student::class, 'pendaftaran_id');
}
}