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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Link ke Login User
            
            // Link ke Data Pendaftaran (Bisa null jika data lama diimport manual)
            $table->foreignId('registration_id')->nullable()->constrained('registrations')->nullOnDelete();
            
            // Identitas Akademik
            $table->string('nim')->unique();
            $table->string('prodi_universitas')->nullable();
            $table->string('fakultas_universitas')->nullable();
            $table->integer('angkatan'); // Contoh: 2025
            
            // Data Kesantrian
            $table->string('kamar_asrama')->nullable(); 
            $table->string('nama_wali')->nullable();
            $table->string('kontak_wali')->nullable();
            
            $table->enum('status_mahad', ['aktif', 'lulus', 'boyong', 'cuti'])->default('aktif');
            $table->timestamps();
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
