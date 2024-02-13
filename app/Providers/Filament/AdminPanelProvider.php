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
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
// use Swis\Filament\Backgrounds\Images\MyImages;


use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel

            ->viteTheme('resources/css/filament/admin/theme.css')
            ->favicon(asset('images/favicon/favicon 01 (Copy).png'))
            ->brandName('Wedding Bells')
            // ->brandLogo(asset('images/favicon/Wedding Bells Logo.png'))
            ->globalSearch(true)
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->databaseNotifications()
            ->databaseNotificationsPolling('120s')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->resources([
                config('filament-logger.activity_resource')
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                OverlookWidget::class,
            ])
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make(),
                FilamentPeekPlugin::make(),
                FilamentFullCalendarPlugin::make(),
                FilamentBackgroundsPlugin::make()
                ->showAttribution(false)
                ->imageProvider(
                    MyImages::make()
                        ->directory('images\slider\Index')
                ),
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
            // ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            //     return $builder->items([
            //         NavigationItem::make('Dashboard')
            //             ->icon('heroicon-o-home')
            //             ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
            //             ->url(fn (): string => Dashboard::getUrl()),
            //         // Add the custom Pulse dashboard navigation item
            //         NavigationItem::make('Pulse Dashboard')
            //             ->icon('heroicon-o-chart-pie')
            //             ->isActiveWhen(fn (): bool => request()->is('monitersystem/pulse/*'))  // Adjust the route pattern as needed
            //             ->url(fn (): string => config('pulse.path')),
            //         // ... other navigation items
            //     ]);
            // })
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
