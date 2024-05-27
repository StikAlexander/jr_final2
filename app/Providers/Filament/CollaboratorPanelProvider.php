<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CollaboratorLogin;
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

class CollaboratorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('collaborator')
            ->path('collaborator')
            ->login(CollaboratorLogin::class)
            ->colors([
                'primary' => '#9b9fa2', // Color personalizado para el panel de empleados
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::Cyan,
                'success' => Color::Lime,
                'warning' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Collaborator/Resources'), for: 'App\\Filament\\Collaborator\\Resources')
            ->discoverPages(in: app_path('Filament/Collaborator/Pages'), for: 'App\\Filament\\Collaborator\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Collaborator/Widgets'), for: 'App\\Filament\\Collaborator\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
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
            ]);
    }
}
