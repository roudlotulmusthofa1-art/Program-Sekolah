<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biaya_pendidikans', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $table->foreignId('jenis_biaya_id')->constrained('jenis_biayas')->cascadeOnDelete();
            $table->unsignedBigInteger('nominal');
            $table->enum('frekuensi', [
                'sekali',
                'harian',
                'mingguan',
                'bulanan',
                'semester',
                'tahunan'
            ])->default('Sekali');
            $table->timestamps();
            $table->unique(['tahun_ajaran_id', 'jenis_biaya_id'], 'biaya_pendidikan_unik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_pendidikans');
    }
};
