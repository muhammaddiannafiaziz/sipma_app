<?php

namespace App\Livewire\Auth;

use App\Models\AcademicYear;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class RegisterSantri extends Component
{
    // Input Form
    public $nim;
    public $password;
    public $password_confirmation;

    // State
    public $studentData = null;
    public $step = 1;

    // VALIDASI UTAMA: Pastikan bagian ini ada!
    protected $rules = [
        'nim' => 'required|numeric|digits:9|unique:users,identity_number',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        'nim.required' => 'NIM wajib diisi.',
        'nim.numeric' => 'NIM harus berupa angka.',
        'nim.digits' => 'NIM harus tepat 9 digit angka.', // Pesan Error Khusus
        'nim.unique' => 'NIM ini sudah terdaftar. Silakan login.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password.min' => 'Password minimal 8 karakter.',
    ];

    public function checkNim()
    {
        // 1. Jalankan Validasi Sesuai $rules di atas
        $this->validateOnly('nim');

        // 2. Ambil Tahun Akademik Aktif
        $activeYear = AcademicYear::where('is_active', true)->first();

        if (!$activeYear) {
            $this->addError('nim', 'Sistem Error: Belum ada Tahun Akademik Aktif.');
            return;
        }

        // 3. Validasi Angkatan (2 Digit Awal)
        $yearPrefix = substr($activeYear->name, 2, 2); // Ambil "24" dari "2024/2025"
        $nimPrefix = substr($this->nim, 0, 2); // Ambil 2 digit awal NIM

        if ($nimPrefix !== $yearPrefix) {
            $this->addError('nim', "Pendaftaran ditolak. Hanya untuk angkatan 20{$yearPrefix}.");
            return;
        }

        // 4. Cek API
        $apiResult = $this->mockSiakadApi($this->nim);

        if (!$apiResult['status']) {
            $this->addError('nim', 'Data NIM tidak ditemukan di Universitas.');
            return;
        }

        $this->studentData = $apiResult['data'];
        $this->step = 2;
    }

    private function mockSiakadApi($nim)
    {
        return [
            'status' => true,
            'data' => [
                'nama_lengkap' => 'Calon Santri ' . $nim,
                'prodi' => 'Teknik Informatika',
                'fakultas' => 'Sains dan Teknologi',
                'kode_prodi' => 'TI-01'
            ]
        ];
    }

    public function register()
    {
        $this->validate(); // Validasi Password

        /////////////////////////
        // NANTI HRUS DIGANTI //
        ////////////////////////
        // Buat User 
        $user = User::create([
            'name' => $this->studentData['nama_lengkap'],
            'email' => $this->nim . '@mhs.uinsaid.ac.id',
            'identity_number' => $this->nim,
            'password' => Hash::make($this->password),
            'is_active' => true,
        ]);

        // Assign Role
        try {
            $user->assignRole('santri');
        } catch (\Exception $e) {
            // Role fallback
        }

        // Isi Profil Awal
        $activeYear = AcademicYear::where('is_active', true)->first();
        $firstSemester = $activeYear->semesters()->where('name', 'like', '%Ganjil%')->first();

        StudentProfile::create([
            'user_id' => $user->id,
            'entry_period_index' => $firstSemester?->period_index ?? 1,
            'prodi' => $this->studentData['prodi'],
            'fakultas' => $this->studentData['fakultas'],
            'academic_status' => 'active',
        ]);

        Auth::login($user);

        return redirect('/santri');
    }

    public function render()
    {
        return view('livewire.auth.register-santri');
    }
}