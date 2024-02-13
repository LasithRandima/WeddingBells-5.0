<?php

namespace App\Filament\Resources\TopAdResource\Widgets;

use App\Filament\Resources\TopAdResource\Pages\ListTopAds ;
use App\Models\Advertisement;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TopAdvertisementStats extends BaseWidget
{
    // use InteractsWithPageTable;


    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListTopAds::class;
    }






    protected function getStats(): array
    {

        function calculateTrends($data)
        {
            $allData = [];
            $chartColor = null;
            $desc = null;
            $descIcon = null;
            $monthCount = 0;

            foreach ($data as $user => $value) {
                // Count the number of items for the current month
                $count = $value->count();

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

                // Increment the month count
                $monthCount++;

                // Break the loop if we have processed 12 months
                if ($monthCount >= 12) {
                    break;
                }
            }

            return [
                'chartColor' => $chartColor,
                'desc' => $desc,
                'descIcon' => $descIcon,
            ];
        }


        $Ads = Advertisement::select('created_at')->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allAds = [];
        foreach ($Ads as $user => $value) {
            array_push($allAds, $value->count());
        }
        $adsInfo = calculateTrends($Ads);


        $topAds = Advertisement::select('created_at')->where('ad_type', 1)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $allTopAds = [];
        foreach ($topAds  as $user => $value) {
            array_push($allTopAds, $value->count());
        }
        $topAdsInfo = calculateTrends($topAds);


        return [
            // Stat::make('Total Advertisements', Advertisement::where('v_id', Auth::id())->get()->count()),
            // Stat::make('Total Normal Ads', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->get()->count()),
            // Stat::make('Total Pendings', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->where('approrval_status', 'pending_approval')->get()->count()),
            Stat::make('All Advertisements', Advertisement::all()->count())
                ->description( $adsInfo['desc'])
                ->descriptionIcon( $adsInfo['descIcon'])
                ->chart($allAds)
                ->color($adsInfo['chartColor']),
            Stat::make('All Top Ads', Advertisement::where('ad_type', 1)->get()->count())
                ->description( $topAdsInfo['desc'])
                ->descriptionIcon( $topAdsInfo['descIcon'])
                ->chart($allTopAds)
                ->color($topAdsInfo['chartColor']),
            Stat::make('Total Pendings', Advertisement::where('ad_type', 0)->where('approrval_status', 'pending_approval')->get()->count()),
        ];
    }
}
