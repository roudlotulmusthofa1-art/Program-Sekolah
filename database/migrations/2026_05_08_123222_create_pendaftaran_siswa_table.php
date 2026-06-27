<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique(); // e.g. PSB-2026-00093

            // STEP 1 - DATA PRIBADI
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('email')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedTinyInteger('anak_ke');
            $table->unsignedTinyInteger('jumlah_saudara');
            $table->text('alamat');
            $table->string('no_telepon', 20);

            // STEP 2 - DATA ORANG TUA
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_phone', 20)->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_phone', 20)->nullable();
            $table->text('parent_address')->nullable();
            $table->enum('income', ['<1jt', '1-3jt', '3-5jt', '5-10jt', '>10jt'])->nullable();

            // STEP 3 - PENDIDIKAN
            $table->string('school_name')->nullable();
            $table->enum('education_level', ['SD / MI', 'SMP / MTs', 'SMA / MA', 'SMK'])->nullable();
            $table->year('graduation_year')->nullable();
            $table->text('achievement')->nullable();

            // STEP 4 - KESEHATAN
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->text('medical_history')->nullable();
            $table->text('allergy')->nullable();
            $table->text('special_condition')->nullable();

            // STEP 5 - KEAGAMAAN
            $table->enum('quran_reading_ability', ['belum_bisa', 'iqro', 'terbata', 'lancar', 'tartil'])->nullable();
            $table->unsignedTinyInteger('memorized_juz')->default(0)->nullable();
            $table->enum('previous_pesantren', ['ya', 'tidak'])->nullable();
            $table->text('religious_skill')->nullable();

            // STEP 6 - INFO LAINNYA
            $table->string('hobby_talent')->nullable();
            $table->string('extracurricular_interest')->nullable();
            $table->text('future_goal')->nullable();

            // STEP 7 - DOKUMEN
            $table->string('photo')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('family_card')->nullable();
            $table->string('certificate')->nullable();

            // STEP 8 - MOTIVASI
            $table->text('alasan')->nullable();

            // STEP 9 - VERIFIKASI & STATUS
            $table->boolean('agree_rules')->default(false);
            $table->boolean('agree_payment')->default(false);
            $table->boolean('agree_data_truth')->default(false);
            $table->enum('status', ['pending', 'follow_up', 'dihubungi', 'dalam_proses', 'diterima', 'ditolak'])->default('pending');
            $table->unsignedTinyInteger('last_step')->default(0);
            $table->date('tanggal_daftar')->nullable();
            $table->string('periode_psb')->nullable(); // e.g. PSB 2026
            $table->text('catatan_admin')->nullable();
            
            // Relasi ke guardian, student, school_classes
            $table->unsignedBigInteger('guardian_id')->nullable();
            // $table->foreignId('student_id')->nullable()->constrained('students')->nullOnDelete();
            // $table->foreignId('school_classes_id')->nullable()->constrained('school_classes')->nullOnDelete();

            $table->boolean('is_archived')->default(false);
            $table->timestamp('diterima_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_siswa');
    }
};
