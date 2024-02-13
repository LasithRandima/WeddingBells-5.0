<?php

namespace App\Filament\Merchants\Resources\SocialNetworkResource\Pages;

use App\Filament\Merchants\Resources\SocialNetworkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialNetworks extends ListRecords
{
    protected static string $resource = SocialNetworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
