<?php

namespace App\Filament\Merchants\Resources\VendorAdvertisementsResource\Pages;

use App\Filament\Merchants\Resources\VendorAdvertisementsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;


class CreateVendorAdvertisements extends CreateRecord
{
    protected static string $resource = VendorAdvertisementsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function beforeFill(): void
    {
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $package_expire_date = DB::table('payments')->select('package_expire')->where('v_id', '=', Auth::id())->value('package_expire');
        $package_name = DB::table('site_packages')->select('pkg_name')->where('id', '=', $package_id )->value('pkg_name');
        $ads_limit = DB::table('payments')->select('ads_count')->where('v_id', '=', Auth::id())->value('ads_count');
        $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 0)->count();
        $remaining_ads = $ads_limit - $Ads_Count;

        if ($remaining_ads <= 3) {
            $message = "You are on {$package_name} Plan. ";
            $message .= "You have limit of {$ads_limit} Top Ads. ";
            $message .= "You currently have {$Ads_Count} ads, and your remaining is {$remaining_ads}. ";
            $message .= 'Please upgrade your package to add more.';

            Notification::make()
                ->title('Package Details')
                ->body($message)
                // ->icon('fas-pager')
                ->info()
                ->persistent()
                ->send();

        }

        if ($package_expire_date < now()) {
            $message = "You are on {$package_name} Plan. ";
            $message .= 'Seems like you have not renewed your package. ';
            $message .= "Your package has expired on {$package_expire_date}. ";
            $message .= 'Please upgrade your package For Create Ads.';

            Notification::make()
                ->title('Package Expired')
                ->body($message)
                // ->icon('fas-pager')
                ->danger()
                ->persistent()
                ->send();

            Notification::make()
                ->title('Package Expired')
                // ->icon('fas-pager')
                ->body($message)
                ->danger()
                ->sendToDatabase(auth()->user());

        }
    }


    protected function beforeCreate(): void
    {
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $package_expire_date = DB::table('payments')->select('package_expire')->where('v_id', '=', Auth::id())->value('package_expire');
        $package_name = DB::table('site_packages')->select('pkg_name')->where('id', '=', $package_id)->value('pkg_name');
        $ads_limit = DB::table('payments')->select('ads_count')->where('v_id', '=', Auth::id())->value('ads_count');
        $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 0)->count();


            if ($Ads_Count >= $ads_limit) {
                $message = "You are on {$package_name} Plan ";
                $message .= 'You have reached your limit of Normal Ads. ';
                $message .= "You currently have {$Ads_Count} ads, and your limit is {$ads_limit}. ";
                $message .= 'Please upgrade your package to add more.';

                Notification::make()
                    ->title('Normal Ads Limit Reached')
                    ->body($message)
                    ->warning()
                    ->send();

                abort(403, $message);
            }

            if ($package_expire_date < now()) {
                $message = "You are on {$package_name} Plan. ";
                $message .= 'Seems like you have not renewed your package. ';
                $message .= "Your package has expired on {$package_expire_date}. ";
                $message .= 'Please upgrade your package For Create Ads.';

                Notification::make()
                    ->title('Package Expired')
                    ->body($message)
                    ->danger()
                    ->persistent()
                    ->send();

                abort(403, $message);
            }
        }



}
