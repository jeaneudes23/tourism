<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditFacilityProfile;
use App\Filament\Pages\Tenancy\RegisterFacility;
use App\Models\Facility;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
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

class FacilityPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('facility')
            ->login()
            ->databaseNotifications()
            ->spa()
            ->navigationItems([
                NavigationItem::make()
                ->label('Front Page')
                ->icon('heroicon-o-newspaper')
                ->openUrlInNewTab(true)
                ->url(fn () => route('facilities.show', ['facility' => Filament::getTenant()->slug]))
            ])
            ->tenant(Facility::class , slugAttribute: 'slug')
            // ->tenantRegistration(RegisterFacility::class)
            ->tenantProfile(EditFacilityProfile::class)
            ->path('facility')
            ->colors([
                'primary' => '#659bad',
            ])
            ->discoverResources(in: app_path('Filament/Facility/Resources'), for: 'App\\Filament\\Facility\\Resources')
            ->discoverPages(in: app_path('Filament/Facility/Pages'), for: 'App\\Filament\\Facility\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Facility/Widgets'), for: 'App\\Filament\\Facility\\Widgets')
            ->widgets([
                
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
