<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    protected $fillable = [
        'user_id',
        'admission_wave_id',
        'no_pendaftaran',
        'status',
        
        // Data Akademik (PENTING: Tambahkan ini)
        'sekolah_asal',
        'pernah_mondok',
        'nama_pondok',
        'lama', // Sesuai nama kolom di DB
        'prestasi',
        
        // Data Upload
        'pas_foto',
        'uploaded_files',
        
        // Hasil Wawancara (Untuk Admin nanti)
        'catatan_wawancara',
        'interviewer_id',
    ];

    protected $casts = [
        'pernah_mondok' => 'boolean',
        'uploaded_files' => 'array', // Casting JSON agar file upload tersimpan benar
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }
}