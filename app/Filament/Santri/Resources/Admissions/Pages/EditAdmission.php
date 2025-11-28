<?php

namespace App\Filament\Santri\Resources\Admissions\Pages; // NAMESPACE PLURAL

use App\Filament\Santri\Resources\Admissions\AdmissionResource; // IMPORT RESOURCE
use Filament\Resources\Pages\EditRecord;

class EditAdmission extends EditRecord
{
    protected static string $resource = AdmissionResource::class;

    protected function getRedirectUrl(): string
    {
        return filament()->getPanel('santri')->getUrl(); 
    }
}