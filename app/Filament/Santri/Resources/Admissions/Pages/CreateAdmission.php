<?php

namespace App\Filament\Santri\Resources\Admissions\Pages; // Namespace Plural

use App\Filament\Santri\Resources\Admissions\AdmissionResource;
use App\Models\AdmissionWave;
use App\Models\StudentProfile;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr; // Helper Array Laravel

class CreateAdmission extends CreateRecord
{
    protected static string $resource = AdmissionResource::class;
    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Definisikan Kolom yang Milik 'student_profiles'
        $profileFields = [
            'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp',
            'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'jalan', 'kode_pos',
            'nama_ortu', 'pekerjaan_ortu', 'pendidikan_ortu', 'nohp_ortu'
        ];

        // 2. Ambil data profil dari form
        $profileData = Arr::only($data, $profileFields);

        // 3. Update data ke tabel student_profiles milik user yang sedang login
        // (Record student_profiles sudah dibuat kosong saat RegisterSantri di Step 3)
        StudentProfile::where('user_id', Auth::id())->update($profileData);

        // 4. Bersihkan array $data agar hanya tersisa kolom milik 'admissions'
        // Kalau tidak dibersihkan, SQL akan error: "Column not found: tempat_lahir"
        $admissionData = Arr::except($data, $profileFields);

        // 5. Lengkapi data sistem untuk tabel 'admissions'
        $admissionData['user_id'] = Auth::id();
        $activeWave = AdmissionWave::where('is_open', true)->first();
        $admissionData['admission_wave_id'] = $activeWave?->id;
        
        $year = date('Y');
        $count = \App\Models\Admission::whereYear('created_at', $year)->count() + 1;
        $admissionData['no_pendaftaran'] = 'REG-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        $admissionData['status'] = 'submitted';

        return $admissionData; // Kembalikan array bersih ke Filament untuk disimpan
    }
    
    protected function getRedirectUrl(): string
    {
        return filament()->getPanel('santri')->getUrl(); 
    }
}