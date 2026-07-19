<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_school_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_class_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bidang_ilmu_id')->nullable()
                ->constrained('bidang_ilmu')->nullOnDelete(); // sesuaikan nama tabel Bidang Ilmu-nya
            $table->timestamps();

            $table->unique(['teacher_id', 'school_class_id', 'bidang_ilmu_id'], 'teacher_class_subject_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_school_class');
    }
};