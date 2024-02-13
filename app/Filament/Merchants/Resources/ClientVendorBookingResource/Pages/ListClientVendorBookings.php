<?php

namespace App\Filament\Merchants\Resources\ClientVendorBookingResource\Pages;

use App\Filament\Merchants\Resources\ClientVendorBookingResource;
use App\Filament\Merchants\Resources\ClientVendorBookingResource\Widgets\BookingStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientVendorBookings extends ListRecords
{
    protected static string $resource = ClientVendorBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ClientVendorBookingResource\Widgets\BookingCalendar::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BookingStats::class,
        ];
    }
}
