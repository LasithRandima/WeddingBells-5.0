<?php

namespace App\Filament\Merchants\Resources\VendorTopAdResource\Pages;

use App\Filament\Merchants\Resources\VendorTopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVendorTopAd extends ViewRecord
{
    protected static string $resource = VendorTopAdResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
