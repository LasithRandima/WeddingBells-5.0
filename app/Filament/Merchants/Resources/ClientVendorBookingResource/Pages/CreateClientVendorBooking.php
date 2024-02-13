<?php

namespace App\Filament\Merchants\Resources\ClientVendorBookingResource\Pages;

use App\Filament\Merchants\Resources\ClientVendorBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class CreateClientVendorBooking extends CreateRecord
{
    protected static string $resource = ClientVendorBookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }





        protected function beforeFill(): void
        {
            $message = "You Can't Create Booking for yourself. ";

            Notification::make()
                ->title($message)
                ->warning()
                ->send();

            abort(403, $message);


        }
}
