<?php

namespace App\Filament\Merchants\Resources\AdsPackageResource\Pages;

use App\Filament\Merchants\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsPackage extends EditRecord
{
    protected static string $resource = AdsPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
