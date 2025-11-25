<?php

namespace App\Providers\Filament;

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
            ->login() // Halaman Login: /santri/login
            // ->registration() // KITA MATIKAN (Comment/Hapus) agar lewat "The Gate"
            ->colors([
                'primary' => Color::Emerald, // Identitas Visual: Hijau
            ])
            ->brandName('Portal Santri') // Branding
            ->favicon(asset('images/favicon.ico')) // Opsional, jika ada
            ->font('IBM Plex Sans')
            ->discoverResources(in: app_path('Filament/Santri/Resources'), for: 'App\\Filament\\Santri\\Resources')
            ->discoverPages(in: app_path('Filament/Santri/Pages'), for: 'App\\Filament\\Santri\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Santri/Widgets'), for: 'App\\Filament\\Santri\\Widgets')
            ->widgets([
                // KITA KOSONGKAN DEFAULT WIDGET AGAR DASHBOARD BERSIH
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            // Aktifkan Edit Profil sederhana
            ->profile(isSimple: false); 
    }
}