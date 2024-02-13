<?php

namespace App\Observers;

use App\Models\ClientVendorBooking;
use App\Models\Advertisement;
use App\Models\User;
use App\Models\Vendor;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientVendorBookingObserver
{
    /**
     * Handle the ClientVendorBooking "created" event.
     */
    public function created(ClientVendorBooking $clientVendorBooking): void
    {
        $actual_vendor_id = $clientVendorBooking->v_id;
        $vendorId = Vendor::select('user_id')->where('id', $actual_vendor_id)->value('user_id');
        $vendorDetails = User::where('id', $vendorId)->get();
        $adId = $clientVendorBooking->id;

        if(Auth::user()->role_id == 3 ){
            Notification::make()
            ->title('New Booking Received From Custormer : '.$clientVendorBooking->c_name)
            ->info()
            ->body(ucfirst(Str::words($clientVendorBooking->message, 8, '...')))
            ->actions([
                Action::make('markAsUnread')
                    ->button()
                    ->markAsRead(),
                // Action::make('View')->url(function () use ($adId) {
                //     return route('advertisements.adpreview', [$adId]);
                // }),
                // Action::make('Edit')->url(function () use ($adId) {
                //     return url(env('APP_URL').'/admin/advertisements/' . $adId . '/edit');
                // }),
            ])
            ->sendToDatabase($vendorDetails);
        }
    }

    /**
     * Handle the ClientVendorBooking "updated" event.
     */
    public function updated(ClientVendorBooking $clientVendorBooking): void
    {
        //
    }

    /**
     * Handle the ClientVendorBooking "deleted" event.
     */
    public function deleted(ClientVendorBooking $clientVendorBooking): void
    {
        //
    }

    /**
     * Handle the ClientVendorBooking "restored" event.
     */
    public function restored(ClientVendorBooking $clientVendorBooking): void
    {
        //
    }

    /**
     * Handle the ClientVendorBooking "force deleted" event.
     */
    public function forceDeleted(ClientVendorBooking $clientVendorBooking): void
    {
        //
    }
}
