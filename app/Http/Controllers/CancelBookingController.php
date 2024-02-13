<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientVendorBooking;

class CancelBookingController extends Controller
{
    public function cancelRequest($bookingId)
    {
        $booking = ClientVendorBooking::findOrFail($bookingId);
        // dd($bookingId);
        $booking->update(['booking_status' => 'cancelled']);
        return redirect()->route('clientVendorBookings.index')->with('message', 'Booking cancelled successfully.');

        app('debugbar')->info('cancellllllllllll id : '+$booking);
    }

    public function cancelBooking($bookingId)
    {
        // Update the booking status to 'cancelled'
        $booking = ClientVendorBooking::findOrFail($bookingId);
        $booking->update(['booking_status' => 'cancelled']);

        // Redirect back to the index page with a success message
        return redirect()->route('clientVendorBookings.index')->with('success', 'Booking cancelled successfully.');
    }
}
