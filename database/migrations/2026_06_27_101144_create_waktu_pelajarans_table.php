<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waktu_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode', 20)->nullable();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waktu_pelajaran');
    }
};