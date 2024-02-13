<?php

namespace App\Filament\Merchants\Resources\VendorFaqResource\Pages;

use App\Filament\Merchants\Resources\VendorFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVendorFaq extends CreateRecord
{
    protected static string $resource = VendorFaqResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
