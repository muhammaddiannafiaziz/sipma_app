<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'entry_period_index',
        'prodi',
        'fakultas',
        // Data Diri
        'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp',
        // Alamat
        'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'jalan', 'kode_pos',
        // Ortu
        'nama_ortu', 'pekerjaan_ortu', 'pendidikan_ortu', 'nohp_ortu',
        // Kesantrian
        'kamar_id', 'academic_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}