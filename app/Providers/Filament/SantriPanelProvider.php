<?php

namespace App\Providers\Filament;

use App\Filament\Santri\Pages\Auth\Login; // IMPORT CLASS LOGIN CUSTOM
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SantriPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('santri')
            ->path('santri')
            
            // PERBAIKAN: Gunakan Class Login Custom (NIM)
            ->login(Login::class) 
            
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->brandName('Portal Santri')
            ->favicon(asset('images/favicon.ico'))
            ->font('IBM Plex Sans')
            ->discoverResources(in: app_path('Filament/Santri/Resources'), for: 'App\\Filament\\Santri\\Resources')
            ->discoverPages(in: app_path('Filament/Santri/Pages'), for: 'App\\Filament\\Santri\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Santri/Widgets'), for: 'App\\Filament\\Santri\\Widgets')
            ->widgets([
                // Default widgets dimatikan agar bersih
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->profile(isSimple: false);
    }
}