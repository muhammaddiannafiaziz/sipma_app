<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    protected $fillable = ['name', 'is_active', 'start_date', 'end_date'];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Helper untuk mengambil tahun aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function admissionWaves(): HasMany
    {
        return $this->hasMany(AdmissionWave::class);
    }
}