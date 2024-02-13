<?php

namespace App\Filament\Merchants\Resources\VendorTopAdResource\Pages;

use App\Filament\Merchants\Resources\VendorTopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorTopAds extends ListRecords
{
    protected static string $resource = VendorTopAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
