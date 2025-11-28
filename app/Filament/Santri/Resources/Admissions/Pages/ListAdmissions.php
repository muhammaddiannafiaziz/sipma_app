<?php

namespace App\Filament\Santri\Resources\Admissions\Pages; // NAMESPACE PLURAL

use App\Filament\Santri\Resources\Admissions\AdmissionResource; // IMPORT RESOURCE
use App\Models\Admission;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAdmissions extends ListRecords
{
    protected static string $resource = AdmissionResource::class;

    public function mount(): void
    {
        $admission = Admission::where('user_id', Auth::id())->first();
        if ($admission) {
            redirect()->to(AdmissionResource::getUrl('edit', ['record' => $admission]));
            return;
        } else {
            redirect()->to(AdmissionResource::getUrl('create'));
            return;
        }
    }
}