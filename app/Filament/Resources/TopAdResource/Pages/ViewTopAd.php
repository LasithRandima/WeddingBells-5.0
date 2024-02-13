<?php

namespace App\Filament\Resources\TopAdResource\Pages;

use App\Filament\Resources\TopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTopAd extends ViewRecord
{
    protected static string $resource = TopAdResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
