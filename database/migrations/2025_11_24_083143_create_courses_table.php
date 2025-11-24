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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique(); // Contoh: MK-TAUHID-1
            $table->string('nama_mk');            // Kitab Tauhid Dasar
            $table->integer('sks')->default(2);
            $table->integer('semester_paket')->default(1); // Biasanya diambil santri semester berapa
            $table->enum('jenis', ['wajib', 'pilihan'])->default('wajib');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
