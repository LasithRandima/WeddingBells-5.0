<?php

namespace App\Filament\Merchants\Resources\ClientVendorBookingResource\Widgets;

use App\Filament\Merchants\Resources\ClientVendorBookingResource\Pages\ListClientVendorBookings;
use App\Models\ClientVendorBooking;
use App\Models\Vendor;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingStats extends BaseWidget
{
    // use InteractsWithPageTable;


    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListClientVendorBookings::class;
    }






    protected function getStats(): array
    {

        function calculateTrends($data)
        {
            $allData = [];
            $chartColor = null;
            $desc = null;
            $descIcon = null;

            $dataArray = $data;

            // Get the last 12 months of data
            $last12MonthsData = array_slice($dataArray, -12, null, true);

            foreach ($last12MonthsData as $user => $value) {
                // Use the value directly (no need for count)
                $count = $value;

                // Check if the values are increasing, decreasing, or constant
                if ($count >= 0) {
                    $trend = $count - end($allData);

                    if ($trend > 0) {
                        // Increasing, set color to success
                        $chartColor = 'success';
                        $desc = 'Increased by ' . $trend;
                        $descIcon = 'heroicon-m-arrow-trending-up';
                    } elseif ($trend < 0) {
                        // Decreasing, set color to danger
                        $chartColor = 'danger';
                        $desc = 'Decreased by ' . abs($trend);
                        $descIcon = 'heroicon-m-arrow-trending-down';
                    } else {
                        // No change, set color to warning
                        $chartColor = 'warning';
                        $desc = 'No change';
                        $descIcon = 'heroicon-m-arrow-long-right';
                    }
                }

                array_push($allData, $count);
                // dd($last12MonthsData);
            }

            return [
                'chartColor' => $chartColor,
                'desc' => $desc,
                'descIcon' => $descIcon,
            ];
        }







        $currentDate = Carbon::now()->toDateString();
        $actual_vid = DB::table('advertisements')
        ->select('actual_v_id')
        ->where('v_id', '=', Auth::id())
        ->value('actual_v_id');


        $vendorId = Vendor::select('id')->where('user_id', Auth::id())->value('id');

        $AllBookings = ClientVendorBooking::select('created_at')->where('v_id',  $vendorId)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allBooks = [];
        foreach ($AllBookings as $user => $value) {
            array_push($allBooks, $value->count());
        }
        $allbookingsInfo = calculateTrends( $allBooks);


        $AllBooked = ClientVendorBooking::select('created_at')->where('v_id',  $vendorId)->where('booking_status', 'booked')->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allBookedArray = [];
        foreach ($AllBooked as $user => $value) {
            array_push($allBookedArray, $value->count());
        }
        $allbookedInfo = calculateTrends($allBookedArray);


        $AllPending = ClientVendorBooking::select('created_at')->where('v_id',  $vendorId)->where('booking_status', 'pending')->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allPendingArray = [];
        foreach ($AllPending as $user => $value) {
            array_push($allPendingArray, $value->count());
        }
        $allPendingInfo = calculateTrends($allPendingArray);




        return [
            // Stat::make('Total Advertisements', Advertisement::where('v_id', Auth::id())->get()->count()),
            // Stat::make('Total Normal Ads', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->get()->count()),
            // Stat::make('Total Pendings', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->where('approrval_status', 'pending_approval')->get()->count()),
            Stat::make('*All Bookings Requests', ClientVendorBooking::where('v_id', $actual_vid)->get()->count())
            ->description( $allbookingsInfo['desc'])
            ->descriptionIcon( $allbookingsInfo['descIcon'])
            ->chart($allBooks)
            ->color($allbookingsInfo['chartColor']),

            Stat::make('*All Booked', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'booked')->get()->count())
            ->description( $allbookedInfo['desc'])
            ->descriptionIcon( $allbookedInfo['descIcon'])
            ->chart($allBookedArray)
            ->color($allbookedInfo['chartColor']),

            Stat::make('*All Pendings', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'pending')->get()->count())
            ->description( $allPendingInfo['desc'])
            ->descriptionIcon( $allPendingInfo['descIcon'])
            ->chart($allPendingArray)
            ->color($allPendingInfo['chartColor']),
            // Stat::make('Total Pendings', Advertisement::where('ad_type', 0)->where('approrval_status', 'pending_approval')->get()->count()),
        ];
    }
}
