<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class AdmissionWave extends Model
{
    protected $fillable = ['academic_year_id', 'name', 'description', 'start_date', 'end_date', 'is_open'];

    protected $casts = [
        'is_open' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Scope untuk mencari gelombang yang BUKA hari ini
    public function scopeOpenNow($query)
    {
        $now = Carbon::now();
        return $query->where('is_open', true)
                     ->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}