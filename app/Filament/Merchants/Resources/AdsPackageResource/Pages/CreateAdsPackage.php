<?php

namespace App\Filament\Merchants\Resources\AdsPackageResource\Pages;

use App\Filament\Merchants\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdsPackage extends CreateRecord
{
    protected static string $resource = AdsPackageResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    
}
