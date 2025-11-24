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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periodes'); // Relasi ke Gelombang
            
            $table->string('no_daftar')->unique(); // Generate otomatis: REG2025001
            $table->string('nama_lengkap');
            $table->string('nik', 16)->nullable();
            $table->string('nisn', 10)->nullable();
            $table->string('whatsapp');
            $table->string('asal_sekolah')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            
            // Status Workflow Penerimaan
            $table->enum('status', ['draft', 'berkas_diupload', 'verifikasi_admin', 'lulus', 'gagal'])->default('draft');
            $table->text('catatan_admin')->nullable(); // Alasan jika ditolak
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
