<?php

namespace App\Filament\Merchants\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use App\Models\Advertisement;
use App\Models\ClientVendorBooking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingsChart extends ChartWidget
{
    protected static ?string $heading = 'Booking Chart';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $currentDate = Carbon::now()->toDateString();
        $actual_vid = DB::table('advertisements')
        ->select('actual_v_id')
        ->where('v_id', '=', Auth::id())
        ->value('actual_v_id');

        $bookings = ClientVendorBooking::select('created_at')->where('v_id', $actual_vid)->where('booking_status', 'booked')->get()->groupby(function($bookings) {
            return Carbon::parse($bookings->created_at)->format('F');
        });
        $quantities = [];
        foreach ($bookings as $booking => $value) {
            array_push($quantities, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $bookings->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
