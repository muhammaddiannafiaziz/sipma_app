<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionWave extends Model
{
    protected $fillable = [
        'academic_year_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'is_open',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}