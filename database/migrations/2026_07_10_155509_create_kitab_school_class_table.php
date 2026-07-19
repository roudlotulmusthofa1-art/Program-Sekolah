<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pivot: satu kitab bisa dipakai di banyak kelas, dan tiap pasangan
        // kitab+kelas punya semester & frekuensi/minggu sendiri.
        // Ini memungkinkan satu kitab diajarkan di kelas A semester 1
        // dan kelas B semester 2 dengan frekuensi berbeda.
        Schema::create('kitab_school_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kitab_id')
                ->constrained('kitabs')
                ->cascadeOnDelete();
            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('semester'); // 1 atau 2
            $table->unsignedTinyInteger('frekuensi_per_minggu')->default(1);
            $table->timestamps();

            $table->unique(
                ['kitab_id', 'school_class_id', 'semester'],
                'kitab_kelas_semester_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kitab_school_class');
    }
};