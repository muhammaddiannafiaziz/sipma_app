<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        // 1. Tahun Akademik (Misal: 2025/2026)
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "2025/2026"
            $table->boolean('is_active')->default(false); // Hanya satu yg aktif
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });


        // 2. Semester (Misal: Ganjil, Genap)
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // "Ganjil", "Genap", "Pendek"
           
            // PERBAIKAN: Ditambahkan tanda kutip pada 'period_index'
            $table->integer('period_index')->unique(); // Urutan absolut (1, 2, 3...)
           
            $table->boolean('is_active')->default(false); // Semester aktif kuliah
            $table->boolean('is_krs_open')->default(false); // Masa KRS
            $table->timestamps();
        });


        // 3. Gelombang Pendaftaran
        Schema::create('admission_waves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // "Gelombang 1"
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('admission_waves');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('academic_years');
    }
};

