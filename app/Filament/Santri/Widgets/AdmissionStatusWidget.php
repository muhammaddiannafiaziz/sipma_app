<?php

namespace App\Filament\Santri\Widgets;

use App\Models\Admission;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class AdmissionStatusWidget extends Widget
{
    protected string $view = 'filament.santri.widgets.admission-status-widget';
    
    protected int | string | array $columnSpan = 'full';

    // TAMBAHKAN INI: Matikan lazy load agar widget langsung dirender
    protected static bool $isLazy = false;

    public function getViewData(): array
    {
        return [
            'admission' => Admission::where('user_id', Auth::id())->first(),
        ];
    }
}