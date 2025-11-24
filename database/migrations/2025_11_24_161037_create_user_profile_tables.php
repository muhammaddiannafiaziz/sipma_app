<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        // Profil Santri
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
           
            // LOGIC BARU: Penanda angkatan masuk berdasarkan urutan global semester
            $table->integer('entry_period_index')->nullable();


            // Data Akademik Universitas
            $table->string('prodi')->nullable();
            $table->string('fakultas')->nullable();


            // Biodata Diri
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('no_hp')->nullable();


            // Alamat Lengkap
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('kode_pos')->nullable();


            // Data Orang Tua
            $table->string('nama_ortu')->nullable();
            $table->string('pekerjaan_ortu')->nullable();
            $table->string('pendidikan_ortu')->nullable();
            $table->string('nohp_ortu')->nullable();


            // Data Kesantrian
            $table->string('kamar_id')->nullable();
            // $table->enum('status_masuk', ['Baru', 'Pindahan'])->default('Baru'); // Dihapus karena pasti mahasiswa baru
           
            // Status Akademik Global (Aktif/Lulus/DO)
            $table->enum('academic_status', ['active', 'graduated', 'dropout', 'leave'])->default('active');


            $table->timestamps();
        });


        // Profil Dosen
        Schema::create('lecturer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nip')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->timestamps();
        });


        // Profil Musyrif
        Schema::create('supervisor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('area_tugas')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('supervisor_profiles');
        Schema::dropIfExists('lecturer_profiles');
        Schema::dropIfExists('student_profiles');
    }
};

