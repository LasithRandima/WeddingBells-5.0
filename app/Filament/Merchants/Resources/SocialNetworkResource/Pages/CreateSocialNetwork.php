<?php

namespace App\Filament\Merchants\Resources\SocialNetworkResource\Pages;

use App\Filament\Merchants\Resources\SocialNetworkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSocialNetwork extends CreateRecord
{
    protected static string $resource = SocialNetworkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
