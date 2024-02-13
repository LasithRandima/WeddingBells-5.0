<?php

namespace App\Filament\Widgets;

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
    protected static ?int $sort = 7;

    public function fetchEvents(array $fetchInfo): array
    {
        $actual_vid = DB::table('advertisements')
            ->select('actual_v_id')
            ->where('v_id', '=', Auth::id())
            ->value('actual_v_id');

        if (Auth::user()->role_id == 2) {
            $bookings = ClientVendorBooking::where('booking_status', 'pending')
                ->where('v_id', $actual_vid)
                ->get();
        }
        if (Auth::user()->role_id == 1) {
            $bookings = ClientVendorBooking::where('booking_status', 'booked')->get();
        }

        return $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->message,
                'start' => $booking->event_date,
                // 'url' => Auth::user()->role_id == 2 ? 'http://wedding-bells-4.0.test/merchants/client-vendor-bookings/' . $booking->id . '/edit' : null,

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
            Forms\Components\TextInput::make('c_name')
            ->label('Client Name'),
            Forms\Components\TextInput::make('c_email')
            ->label('Client Email'),
            Forms\Components\TextInput::make('c_tpno')
            ->label('Client Telephone No'),
            Forms\Components\TextInput::make('message')
            ->label('Message'),
            Forms\Components\Select::make('v_id')
            ->relationship(name: 'vendor', titleAttribute: 'v_bus_name')
            ->searchable()
            ->preload()
            ->label('Vendor Name'),


            Forms\Components\Select::make('ad_id')
            ->relationship(name: 'advertisement', titleAttribute: 'ad_title')
            ->searchable()
            ->preload()
            ->label('Advertisement Title'),
            // Forms\Components\TextInput::make('pkg_id')
            // ->label('pacakge Id'),
            Forms\Components\Select::make('pkg_id')
            ->relationship(name: 'adpackage', titleAttribute: 'pkg_name')
            ->searchable()
            ->preload()
            ->label('Package Name'),
        ];
    }


    // public static function canView(): bool
    // {
    //     return true;
    // }
}
