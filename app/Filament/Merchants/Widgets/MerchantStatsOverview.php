<?php

namespace App\Filament\Merchants\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Carbon\Carbon;
use App\Models\Advertisement;
use App\Models\ClientVendorBooking;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MerchantStatsOverview extends BaseWidget
{

    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $currentDate = Carbon::now()->toDateString();
        $actual_vid = DB::table('advertisements')
        ->select('actual_v_id')
        ->where('v_id', '=', Auth::id())
        ->value('actual_v_id');


        function calculateTrends($data)
        {
            $allData = [];
            $chartColor = null;
            $desc = null;
            $descIcon = null;

            // Convert the collection to an array
            $dataArray = $data->toArray();

            // Get the last 12 months of data
            $last12MonthsData = array_slice($dataArray, -12, null, true);

            foreach ($last12MonthsData as $user => $value) {
                // Access the 'count' key within each item
                $count = count($value);

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


        $Ads = Advertisement::select('created_at')->where('v_id', Auth::id())->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allAds = [];
        foreach ($Ads as $user => $value) {
            array_push($allAds, $value->count());
        }
        $adsInfo = calculateTrends($Ads);

        $vendorId = Vendor::select('id')->where('user_id', Auth::id())->value('id');

        $AllBookings = ClientVendorBooking::select('created_at')->where('v_id',  $vendorId)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allBooks = [];
        foreach ($AllBookings as $user => $value) {
            array_push($allBooks, $value->count());
        }
        $allbookingsInfo = calculateTrends($AllBookings);

        $AllBooked = ClientVendorBooking::select('created_at')->where('v_id',  $vendorId)->where('booking_status', 'booked')->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allBookedArray = [];
        foreach ($AllBooked as $user => $value) {
            array_push($allBookedArray, $value->count());
        }
        $allbookedInfo = calculateTrends($AllBooked);



        return [
            Stat::make('*My Ads', Advertisement::where('v_id', Auth::id())->get()->count())
            ->description( $adsInfo['desc'])
            ->descriptionIcon( $adsInfo['descIcon'])
            ->chart($allAds)
            ->color($adsInfo['chartColor']),

            Stat::make('*All Bookings Requests', ClientVendorBooking::where('v_id', $actual_vid)->get()->count())
            ->description( $allbookingsInfo['desc'])
            ->descriptionIcon( $allbookingsInfo['descIcon'])
            ->chart($allBooks)
            ->color($allbookingsInfo['chartColor']),

            Stat::make('*All Booked', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'booked')->get()->count())
            ->description( $allbookedInfo['desc'])
            ->descriptionIcon( $allbookedInfo['descIcon'])
            ->chart($allBookedArray )
            ->color($allbookedInfo['chartColor']),

            Stat::make('Bookings Requests', ClientVendorBooking::where('v_id', $actual_vid)->whereDate('created_at', $currentDate)->get()->count())
            ->description('For Today')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Pending Bookings Requests', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'pending')->whereDate('created_at', $currentDate)->get()->count())
            ->description('For Today')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Total Booked', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'booked')->whereDate('created_at', $currentDate)->get()->count())
            ->description('For Today')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Pending Bookings Requests', ClientVendorBooking::where('v_id', $actual_vid)->where('booking_status', 'pending')->whereDate('created_at', $currentDate)->get()->count())
            ->description('For Today')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
