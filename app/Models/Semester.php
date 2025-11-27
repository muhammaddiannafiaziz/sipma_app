<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semester extends Model
{
    protected $fillable = ['academic_year_id', 'name', 'period_index', 'is_active', 'is_krs_open'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_krs_open' => 'boolean',
    ];

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}