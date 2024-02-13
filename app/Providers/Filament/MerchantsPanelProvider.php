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
use Hasnayeen\Themes\ThemesPlugin;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;


use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;

class MerchantsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('merchants')
            ->path('merchants')
            // ->brandName('Wedding Bells')
            ->brandLogo(asset('images/logo/WB_logo_12.png'))
            ->brandLogoHeight('45px')
            ->favicon(asset('images/favicon/favicon 01 (Copy).png'))
            ->viteTheme('resources/css/filament/merchants/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('120s')
            ->discoverResources(in: app_path('Filament/Merchants/Resources'), for: 'App\\Filament\\Merchants\\Resources')
            ->discoverPages(in: app_path('Filament/Merchants/Pages'), for: 'App\\Filament\\Merchants\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Merchants/Widgets'), for: 'App\\Filament\\Merchants\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                OverlookWidget::class,

            ])
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make(),
                FilamentPeekPlugin::make(),
                FilamentFullCalendarPlugin::make(),
                SimpleLightBoxPlugin::make(),
                \Awcodes\Curator\CuratorPlugin::make()
                ->label('Media')
                ->pluralLabel('Media')
                ->navigationIcon('heroicon-o-photo')
                ->navigationGroup('Content')
                ->navigationSort(3)
                ->navigationCountBadge()
                ->resource(\App\Filament\Merchants\Resources\VendorGalleryResource::class),
                OverlookPlugin::make()
                ->sort(2)
                ->columns([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 3,
                    'lg' => 4,
                    'xl' => 5,
                    '2xl' => null,
                ]),
                QuickCreatePlugin::make()
                    ->sortBy('navigation'),
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
