<?php

namespace App\Filament\Santri\Resources\Admissions\Pages;

use App\Filament\Santri\Resources\Admissions\AdmissionResource;
use App\Models\StudentProfile;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class EditAdmission extends EditRecord
{
    protected static string $resource = AdmissionResource::class;

    // 1. SAAT FORM DIBUKA: Ambil data dari StudentProfile & gabung ke form
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil data profil santri yang sedang login (atau pemilik data admission ini)
        $studentProfile = StudentProfile::where('user_id', $this->record->user_id)->first();

        if ($studentProfile) {
            // Gabungkan data profil (tempat_lahir, alamat, dll) ke dalam data form admission
            $data = array_merge($data, $studentProfile->toArray());
        }

        return $data;
    }

    // 2. SAAT TOMBOL SAVE DITEKAN: Pecah data ke 2 tabel
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Daftar field yang masuk ke tabel 'student_profiles'
        $profileFields = [
            'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp',
            'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'jalan', 'kode_pos',
            'nama_ortu', 'pekerjaan_ortu', 'pendidikan_ortu', 'nohp_ortu'
        ];

        // Ambil bagian data profil
        $profileData = Arr::only($data, $profileFields);

        // Update tabel student_profiles
        StudentProfile::where('user_id', $this->record->user_id)->update($profileData);

        // Kembalikan sisa data (sekolah_asal, file upload) untuk disimpan ke tabel 'admissions'
        return Arr::except($data, $profileFields);
    }

    protected function getRedirectUrl(): string
    {
        return filament()->getPanel('santri')->getUrl();
    }
}