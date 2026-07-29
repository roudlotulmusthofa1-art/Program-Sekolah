<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Master data Jenis Biaya (Pendaftaran, SPP, Uang Gedung, dll).
     */
    public function up(): void
    {
        Schema::create('jenis_biayas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->boolean('status')->default(true); // aktif / nonaktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_biayas');
    }
};
