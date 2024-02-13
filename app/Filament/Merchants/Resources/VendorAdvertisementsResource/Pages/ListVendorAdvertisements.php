<?php

namespace App\Filament\Merchants\Resources\VendorAdvertisementsResource\Pages;

use App\Filament\Merchants\Resources\VendorAdvertisementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorAdvertisements extends ListRecords
{
    protected static string $resource = VendorAdvertisementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
