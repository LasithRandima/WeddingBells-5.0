<?php

namespace App\Filament\Resources\SitePackageResource\Pages;

use App\Filament\Resources\SitePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSitePackage extends CreateRecord
{
    protected static string $resource = SitePackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
