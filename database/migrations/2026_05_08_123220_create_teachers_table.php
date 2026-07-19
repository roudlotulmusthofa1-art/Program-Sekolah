<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique()->nullable();
            $table->string('teacher_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('photo')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('whatsapp');
            $table->string('catatan')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // status perlu tambahan 'cuti' sesuai tampilan Aktif / Cuti / Non Aktif
        DB::statement("ALTER TABLE teachers MODIFY COLUMN status ENUM('aktif','cuti','nonaktif') DEFAULT 'aktif'");
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['kode', 'photo']);
        });

        DB::statement("ALTER TABLE teachers MODIFY COLUMN status ENUM('aktif','nonaktif') DEFAULT 'aktif'");
    }
};
