<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        // Tabel Pendaftaran
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('admission_wave_id')->constrained();
            $table->string('no_pendaftaran')->unique();


            $table->enum('status', [
                'draft', 'submitted', 'interview_process', 'passed', 'failed'
            ])->default('draft');


            // Data Akademik Lama / Riwayat
            $table->boolean('pernah_mondok')->default(false);
            $table->string('nama_pondok')->nullable();
            $table->string('lama')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('prestasi')->nullable();


            // Data Pendukung
            $table->string('pas_foto')->nullable(); // Foto profil khusus pendaftaran
            $table->json('uploaded_files')->nullable(); // Berkas lain (PDF Ijazah dll)
           
            // Hasil Wawancara
            $table->text('catatan_wawancara')->nullable();
            $table->foreignId('interviewer_id')->nullable()->constrained('users');


            $table->timestamps();
        });


        // Tabel Pembayaran
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            // Relasi ke semester agar bisa bayar berulang tiap semester
            $table->foreignId('semester_id')->constrained();


            $table->decimal('amount', 12, 2);
            $table->string('proof_file')->nullable();


            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('notes')->nullable();


            $table->dateTime('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('admissions');
    }
};
