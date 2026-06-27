<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique()->nullable();

            $table->foreignId('pendaftaran_id')->nullable()->constrained('pendaftaran_siswa')->cascadeOnDelete();

            $table->foreignId('school_class_id')->nullable()->constrained('school_classes')->nullOnDelete();

            $table->foreignId('guardian_id')->nullable()->constrained('guardians')->nullOnDelete();

            $table->string('nis')->unique()->nullable();

            $table->string('name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'keluar/alumni'])->default('aktif');
            $table->boolean('has_fee_scheme')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
