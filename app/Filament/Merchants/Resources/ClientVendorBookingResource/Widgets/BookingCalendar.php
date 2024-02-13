<?php

namespace App\Filament\Merchants\Resources\ClientVendorBookingResource\Widgets;

use App\Models\ClientVendorBooking;
use Filament\Forms;
use Filament\Widgets\Widget;
use Illuminate\Http\Request;
use App\Models\ClientEventPlanner;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Saade\FilamentFullCalendar\Data\EventData; // Import the EventData class
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Merchants\Resources\ClientVendorBookingResource;
use Saade\FilamentFullCalendar\Actions;
use Filament\Actions\Action;

class BookingCalendar extends FullCalendarWidget
{
    // protected static string $view = 'filament.merchants.resources.client-vendor-booking-resource.widgets.booking-calendar';




    public function fetchEvents(array $fetchInfo): array
    {
        $statusMappings = [
            'pending' => '[P]',
            'approved' => '[RA]',
            'confirmed' => '[BC]',
            'booked' => '[B]',
            'rejected' => '[R]',
            'cancelled' => '[C]',
        ];

        $actual_vid = DB::table('advertisements')
            ->select('actual_v_id')
            ->where('v_id', '=', Auth::id())
            ->value('actual_v_id');

        if (Auth::user()->role_id == 2) {
            $bookings = ClientVendorBooking::where('v_id', $actual_vid)
                ->get();
        }
        if (Auth::user()->role_id == 1) {
            $bookings = ClientVendorBooking::where('booking_status', 'booked')->get();
        }

        return $bookings->map(function ($booking) use ($statusMappings) {
            $title = $statusMappings[$booking->booking_status] ?? $booking->booking_status;

            // Concatenate message if it exists
            if ($booking->message) {
                $title .= ' - ' . $booking->message;
            }

            return [
                'title' => $title,
                'start' => $booking->event_date,
                'url' => Auth::user()->role_id == 2 ? 'http://wedding-bells-4.0.test/merchants/client-vendor-bookings/' . $booking->id . '/edit' : null,
                'shouldOpenUrlInNewTab' => true,
            ];
        })->toArray();
    }

    protected function viewAction(): Action
    {
        return Actions\ViewAction::make();
    }

    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }


    public function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('booking_status')
            ->options([
                'pending' => 'Pending',
                'approved' => 'Approved',
                'confirmed' => 'Confirmed',
                'booked' => 'Booked',
                'rejected' => 'Rejected',
                'cancelled' => 'Cancelled',
            ])
            ->label('Booking Status'),
        ];
    }





}
