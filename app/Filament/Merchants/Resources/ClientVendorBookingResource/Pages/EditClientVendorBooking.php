<?php

namespace App\Filament\Merchants\Resources\ClientVendorBookingResource\Pages;

use App\Filament\Merchants\Resources\ClientVendorBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientVendorBooking extends EditRecord
{
    protected static string $resource = ClientVendorBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
