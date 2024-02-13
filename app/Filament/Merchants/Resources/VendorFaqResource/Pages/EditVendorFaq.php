<?php

namespace App\Filament\Merchants\Resources\VendorFaqResource\Pages;

use App\Filament\Merchants\Resources\VendorFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorFaq extends EditRecord
{
    protected static string $resource = VendorFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
