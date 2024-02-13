<?php

namespace App\Filament\Merchants\Resources\VendorGalleryResource\Pages;

use App\Filament\Merchants\Resources\VendorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CreateVendorGallery extends CreateRecord
{
    protected static string $resource = VendorGalleryResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('View Collage Template')->url(function (){
                // if($this->getRecord()->isPublished()){
                //     return route('advertistments.show', [$this->getRecord()]);
                // }
                return route('photocollagetemplate');
            }),

        ];
    }



    protected function beforeFill(): void
    {
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $package_expire_date = DB::table('payments')->select('package_expire')->where('v_id', '=', Auth::id())->value('package_expire');
        $package_name = DB::table('site_packages')->select('pkg_name')->where('id', '=', $package_id)->value('pkg_name');
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $image_limit = DB::table('payments')->select('image_count')->where('v_id', '=', Auth::id())->value('image_count');
        $image_Count = DB::table('vendor_galleries')->select('id')->where('v_id', '=', Auth::id())->count();
        $remaining_images = $image_limit -  $image_Count;

        if ($image_Count <= $image_limit) {
            $message = "You are on {$package_name} Plan.";
            $message = "You have limit of {$image_limit} Images. ";
            $message .= "You currently have { $image_Count} ads, and your remaining is {$remaining_images}. ";
            $message .= 'Please upgrade your package to add more.';

            Notification::make()
                ->title($message)
                ->info()
                ->send();

        }

        if ($package_expire_date < now()) {
            $message = "You are on {$package_name} Plan. ";
            $message .= 'Seems like you have not renewed your package. ';
            $message .= "Your package has expired on {$package_expire_date}. ";
            $message .= 'Please upgrade your package For Create Ads.';

            Notification::make()
                ->title($message)
                ->danger()
                ->persistent()
                ->send();

        }
    }


    protected function beforeCreate(): void
    {
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $package_expire_date = DB::table('payments')->select('package_expire')->where('v_id', '=', Auth::id())->value('package_expire');
        $package_name = DB::table('site_packages')->select('pkg_name')->where('id', '=', $package_id)->value('pkg_name');
        $image_limit = DB::table('payments')->select('image_count')->where('v_id', '=', Auth::id())->value('image_count');
        $image_Count = DB::table('vendor_galleries')->select('id')->where('v_id', '=', Auth::id())->count();



        if ($image_Count >= $image_limit) {
                $message = "You are on {$package_name} Plan ";
                $message = 'You have reached your limit of images. ';
                $message .= "You currently have {$image_Count} images, and your limit is {$image_limit}. ";
                $message .= 'Please upgrade your package to add more.';

                Notification::make()
                    ->title($message)
                    ->warning()
                    ->send();

                abort(403, $message);
            }

            if ($package_expire_date < now()) {
                $message = "You are on {$package_name} Plan. ";
                $message .= 'Seems like you have not renewed your package. ';
                $message .= "Your package has expired on {$package_expire_date}. ";
                $message .= 'Please upgrade your package For Create more images.';

                Notification::make()
                    ->title($message)
                    ->danger()
                    ->persistent()
                    ->send();

                abort(403, $message);
            }


        }


}
