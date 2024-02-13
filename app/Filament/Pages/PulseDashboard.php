<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Config;
use Filament\Actions\Action;




class PulseDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.pulse-dashboard';



    public static ?string $title = 'System Monitoring';
    public static ?string $navigationLabel = 'System Moniter';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('visit-pulse-dashboard')
                ->label(__('Visit Pulse Dashboard'))
                ->url(env('APP_URL').config('pulse.path')) // Replace with the actual path to the Pulse dashboard
                ->openUrlInNewTab()
                ->icon('heroicon-o-cog'),
            // Add other actions as needed
        ];
    }


}
