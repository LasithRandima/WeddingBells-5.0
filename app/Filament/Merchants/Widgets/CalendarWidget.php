<?php

namespace App\Filament\Merchants\Widgets;

use App\Filament\Merchants\Resources\ClientVendorBookingResource;
use App\Models\ClientVendorBooking;
use Illuminate\Database\Eloquent\Model;
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
use App\Filament\Resources\EventResource;
use Saade\FilamentFullCalendar\Actions;
use Filament\Actions\Action;


class CalendarWidget extends FullCalendarWidget
{
    // protected static string $view = 'filament.merchants.resources.no-resource.widgets.calendar-widget';

    public Model | string | null $model = ClientVendorBooking::class;
    protected static ?string $heading = 'Booking Calendar';
    protected static ?int $sort = 5;

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


    protected function headerActions(): array
    {
        return [
        ];
    }


}
