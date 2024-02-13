<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserStats extends BaseWidget
{
    // use InteractsWithPageTable;


    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListUsers::class;
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

        $users = User::select('created_at')->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
            });
            $allUsers = [];
            foreach ($users as $user => $value) {
                array_push($allUsers, $value->count());
            }
            $userInfo = calculateTrends($users);


        $vendors = User::select('created_at')->where('role_id', 2)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
            });
            $allVendors = [];
            foreach ($vendors as $user => $value) {
                array_push($allVendors, $value->count());
            }
            $vendorInfo = calculateTrends($vendors);


        $customers = User::select('created_at')->where('role_id', 3)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
            });
            $allCustormers = [];
            foreach ($users as $user => $value) {
                array_push($allCustormers, $value->count());
            }
            $customerInfo = calculateTrends($customers);


        return [
            // Stat::make('Total Advertisements', Advertisement::where('v_id', Auth::id())->get()->count()),
            // Stat::make('Total Normal Ads', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->get()->count()),
            // Stat::make('Total Pendings', Advertisement::where('v_id', Auth::id())->where('ad_type', 0)->where('approrval_status', 'pending_approval')->get()->count()),
            Stat::make('Users', User::all()->count())
            ->description( $userInfo['desc'])
            ->descriptionIcon( $userInfo['descIcon'])
            ->chart($allUsers)
            ->color($userInfo['chartColor']),

            Stat::make('Customes', User::where('role_id', 3)->get()->count())
            ->description( $customerInfo['desc'])
            ->descriptionIcon( $customerInfo['descIcon'])
            ->chart($allCustormers)
            ->color($customerInfo['chartColor']),

            Stat::make('Vendors', User::where('role_id', 2)->get()->count())
            ->description($vendorInfo['desc'])
            ->descriptionIcon($vendorInfo['descIcon'])
            ->chart($allVendors)
            ->color($vendorInfo['chartColor']),

        ];
    }
}
