<?php

namespace App\Filament\Merchants\Resources\VendorAdvertisementsResource\Pages;

use App\Filament\Merchants\Resources\VendorAdvertisementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVendorAdvertisement extends ViewRecord
{
    protected static string $resource = VendorAdvertisementsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
