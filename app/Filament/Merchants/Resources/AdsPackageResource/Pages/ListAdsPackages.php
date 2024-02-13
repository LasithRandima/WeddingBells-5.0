<?php

namespace App\Filament\Merchants\Resources\AdsPackageResource\Pages;

use App\Filament\Merchants\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsPackages extends ListRecords
{
    protected static string $resource = AdsPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
