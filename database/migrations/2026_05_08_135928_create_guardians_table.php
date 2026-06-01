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
        Schema::create('guardians', function (Blueprint $table) {
        $table->id();

        // DATA CALON SANTRI
        $table->string('student_name');
        $table->string('birth_place');
        $table->date('birth_date');
        $table->enum('gender', ['Laki-laki', 'Perempuan']);
        $table->string('program');

        // DATA ORANG TUA / WALI
        $table->string('guardian_name');
        $table->string('whatsapp');
        $table->string('email')->nullable();

        // SUMBER INFORMASI
        $table->string('information_source')->nullable();

        // password
        $table->string('password');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
