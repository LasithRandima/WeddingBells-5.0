<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Carbon\Carbon;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminStatsOverview extends BaseWidget
{


    protected static ?int $sort = 0;


    protected function getStats(): array
    {
   // Get the current date
   $currentDate = Carbon::now()->toDateString();

   $todaytopAdsCount = Advertisement::where('ad_type', 1)
   ->whereDate('created_at', $currentDate)
   ->count();

   $todayNormalAdsCount = Advertisement::where('ad_type', 0)
   ->whereDate('created_at', $currentDate)
   ->count();





// ---------------All vendors---------------
// Fetch vendors grouped by month
// $vendors = User::select('created_at')->where('role_id', 2)->get()->groupBy(function ($users) {
//     return Carbon::parse($users->created_at)->format('F');
// });

// $allVendors = [];
// $chartColor = null;
// $desc = null;
// $descIcon = null;
// $monthCount = 0;

// foreach ($vendors as $user => $value) {
//     // Count the number of vendors for the current month
//     $count = $value->count();

//     // Check if the values are increasing, decreasing, or constant
//     if ($count >= 0) {
//         $trend = $count - end($allVendors);
//         if ($trend > 0) {
//             // Increasing, set color to success
//             $chartColor = 'success';
//             $desc = 'Increased by ' . $trend;
//             $descIcon = 'heroicon-m-arrow-trending-up';
//         } elseif ($trend < 0) {
//             // Decreasing, set color to danger
//             $chartColor = 'danger';
//             $desc = 'Decreased by ' . abs($trend);
//             $descIcon = 'heroicon-m-arrow-trending-down';
//         } else {
//             // No change, set color to warning
//             $chartColor = 'warning';
//             $desc = 'No change';
//             $descIcon = 'heroicon-m-arrow-long-right';
//         }
//     }

//     array_push($allVendors, $count);

//     // Increment the month count
//     $monthCount++;

//     // Break the loop if we have processed 12 months
//     if ($monthCount >= 12) {
//         break;
//     }

// }

// dd($allVendors);

    // function calculateTrends($data)
    // {
    //     $allData = [];
    //     $chartColor = null;
    //     $desc = null;
    //     $descIcon = null;
    //     $monthCount = 0;

    //     foreach ($data as $user => $value) {
    //         // Count the number of items for the current month
    //         $count = $value->count();

    //         // Check if the values are increasing, decreasing, or constant
    //         if ($count >= 0) {
    //             $trend = $count - end($allData);

    //             if ($trend > 0) {
    //                 // Increasing, set color to success
    //                 $chartColor = 'success';
    //                 $desc = 'Increased by ' . $trend;
    //                 $descIcon = 'heroicon-m-arrow-trending-up';
    //             } elseif ($trend < 0) {
    //                 // Decreasing, set color to danger
    //                 $chartColor = 'danger';
    //                 $desc = 'Decreased by ' . abs($trend);
    //                 $descIcon = 'heroicon-m-arrow-trending-down';
    //             } else {
    //                 // No change, set color to warning
    //                 $chartColor = 'warning';
    //                 $desc = 'No change';
    //                 $descIcon = 'heroicon-m-arrow-long-right';
    //             }
    //         }

    //         array_push($allData, $count);

    //         // Increment the month count
    //         $monthCount++;

    //         // Break the loop if we have processed 12 months
    //         if ($monthCount >= 12) {
    //             break;
    //         }
    //     }

    //     return [
    //         'chartColor' => $chartColor,
    //         'desc' => $desc,
    //         'descIcon' => $descIcon,
    //     ];
    // }



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
        }

        return [
            'chartColor' => $chartColor,
            'desc' => $desc,
            'descIcon' => $descIcon,
        ];
    }




    $vendors = User::select('created_at')->where('role_id', 2)->get()->groupby(function($users) {
    return Carbon::parse($users->created_at)->format('F');
    });
    $allVendors = [];
    foreach ($vendors as $user => $value) {
        array_push($allVendors, $value->count());
    }
    $vendorInfo = calculateTrends($vendors);


    $users = User::select('created_at')->where('role_id', 3)->get()->groupby(function($users) {
        return Carbon::parse($users->created_at)->format('F');
    });
    $allCustormers = [];
    foreach ($users as $user => $value) {
        array_push($allCustormers, $value->count());
    }
    $customerInfo = calculateTrends($users);

    $Ads = Advertisement::select('created_at')->get()->groupby(function($users) {
        return Carbon::parse($users->created_at)->format('F');
    });
    $allAds = [];
    foreach ($Ads as $user => $value) {
        array_push($allAds, $value->count());
    }
    $adsInfo = calculateTrends($Ads);

    $TopAds = Advertisement::select('created_at')->where('ad_type', 1)->get()->groupby(function($users) {
        return Carbon::parse($users->created_at)->format('F');
    });
    $allTopAds = [];
    foreach ($TopAds as $user => $value) {
        array_push($allTopAds, $value->count());
    }
    $topAdsInfo = calculateTrends($TopAds);

    $normalAds = Advertisement::select('created_at')->where('ad_type', 0)->get()->groupby(function($users) {
        return Carbon::parse($users->created_at)->format('F');
    });
    $allNormalAds = [];
    foreach ($normalAds as $user => $value) {
        array_push($allNormalAds, $value->count());
    }
    $normalAdsInfo = calculateTrends($normalAds);
// dd($allNormalAds);




   return [
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
       // ->description('until today')
       // ->descriptionIcon('heroicon-s-trending-up'),

       Stat::make('All Normal Ads', Advertisement::where('ad_type', 0)->get()->count())
       ->description( $normalAdsInfo['desc'])
       ->descriptionIcon( $normalAdsInfo['descIcon'])
       ->chart($allNormalAds)
       ->color($normalAdsInfo['chartColor']),
       // ->description('until today')
       // ->descriptionIcon('heroicon-s-trending-up'),

       Stat::make('Top Ads', $todaytopAdsCount)
       ->description('For today')
       ->descriptionIcon('heroicon-m-arrow-trending-up'),

       Stat::make('Normal Ads', $todayNormalAdsCount)
       ->description('For today')
       ->descriptionIcon('heroicon-m-arrow-trending-up'),

       Stat::make('Vendors', User::where('role_id', 2)->get()->count())
       ->description($vendorInfo['desc'])
       ->descriptionIcon($vendorInfo['descIcon'])
       ->chart($allVendors)
       ->color($vendorInfo['chartColor']),

       Stat::make('Vendors', User::where('role_id', 2)->whereDate('created_at', $currentDate)->get()->count())
       ->description('For today')
       ->descriptionIcon('heroicon-m-arrow-trending-up'),

       Stat::make('Customes', User::where('role_id', 3)->get()->count())
       ->description( $customerInfo['desc'])
       ->descriptionIcon( $customerInfo['descIcon'])
       ->chart($allCustormers)
       ->color($customerInfo['chartColor']),

       Stat::make('Customers', User::where('role_id', 3)->whereDate('created_at', $currentDate)->get()->count())
       ->description('For today')
       ->descriptionIcon('heroicon-m-arrow-trending-up'),

   ];
    }
}
