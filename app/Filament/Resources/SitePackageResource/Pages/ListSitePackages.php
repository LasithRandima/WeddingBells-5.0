<?php

namespace App\Filament\Resources\SitePackageResource\Pages;

use App\Filament\Resources\SitePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSitePackages extends ListRecords
{
    protected static string $resource = SitePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
