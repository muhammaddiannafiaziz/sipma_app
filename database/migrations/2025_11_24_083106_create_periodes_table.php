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
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Contoh: "2025/2026 Ganjil"
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            
            // Saklar Pengatur Sistem
            $table->boolean('is_active_pendaftaran')->default(false); // Buka pendaftaran?
            $table->boolean('is_active_kuliah')->default(false);      // Semester aktif berjalan?
            $table->boolean('is_active_krs')->default(false);         // Masa pengisian KRS?
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};
