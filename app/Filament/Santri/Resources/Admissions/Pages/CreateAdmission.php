<?php

namespace App\Filament\Santri\Resources\Admissions\Pages; // NAMESPACE PLURAL

use App\Filament\Santri\Resources\Admissions\AdmissionResource; // IMPORT RESOURCE
use App\Models\AdmissionWave;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAdmission extends CreateRecord
{
    protected static string $resource = AdmissionResource::class;
    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $activeWave = AdmissionWave::where('is_open', true)->first();
        $data['admission_wave_id'] = $activeWave?->id;
        $year = date('Y');
        $count = \App\Models\Admission::whereYear('created_at', $year)->count() + 1;
        $data['no_pendaftaran'] = 'REG-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        $data['status'] = 'submitted';
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return filament()->getPanel('santri')->getUrl(); 
    }
}