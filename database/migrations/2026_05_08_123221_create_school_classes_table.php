<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->string('slug')->unique();
            $table->string('kategori', 50)->default('Akademik');
            $table->foreignId('wali_kelas_id')->nullable()
                ->constrained('teachers')->nullOnDelete();
            $table->string('color', 20)->default('#3b82f6');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
       Schema::table('school_classes', function (Blueprint $table) {
            $table->dropColumn('kategori');
            $table->dropConstrainedForeignId('wali_kelas_id');
        });
    }
};
