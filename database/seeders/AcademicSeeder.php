<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\AdmissionWave;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Tahun Akademik Aktif
        $academicYear = AcademicYear::create([
            'name' => '2025/2026',
            'is_active' => true,
            'start_date' => Carbon::now()->startOfYear(),
            'end_date' => Carbon::now()->endOfYear(),
        ]);

        // 2. Buat Semester Ganjil (Aktif)
        Semester::create([
            'academic_year_id' => $academicYear->id,
            'name' => 'Ganjil',
            'period_index' => 1, // Semester 1
            'is_active' => true,
            'is_krs_open' => false, // KRS belum buka, masa pendaftaran dulu
        ]);

        // 3. Buat Semester Genap (Tidak Aktif)
        Semester::create([
            'academic_year_id' => $academicYear->id,
            'name' => 'Genap',
            'period_index' => 2, // Semester 2
            'is_active' => false,
            'is_krs_open' => false,
        ]);

        // 4. Buka Gelombang Pendaftaran (PENTING AGAR FORM BISA DIAKSES)
        AdmissionWave::create([
            'academic_year_id' => $academicYear->id,
            'name' => 'Gelombang 1 - Diniyah',
            'description' => 'Pendaftaran santri baru periode awal.',
            'start_date' => Carbon::now()->subDays(1), // Sudah mulai kemarin
            'end_date' => Carbon::now()->addMonths(2), // Tutup 2 bulan lagi
            'is_open' => true,
        ]);
        
        $this->command->info('Data Akademik Awal Berhasil Dibuat: Tahun 2025/2026 Aktif & Gelombang 1 Buka.');
    }
}