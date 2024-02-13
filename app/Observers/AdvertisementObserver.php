<?php

namespace App\Observers;

use App\Models\Advertisement;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdvertisementObserver
{
    /**
     * Handle the Advertisement "created" event.
     */
    public function created(Advertisement $advertisement): void
    {
        // dd($advertisement);
        $adminDetails = User::where('id', 1)->get();
        $adId = $advertisement->id;

        if(Auth::user()->role_id == 2 && $advertisement->approrval_status == 'pending_approval'){
            Notification::make()
            ->title('Advertisement Received For Review Process from vendor : '.$advertisement->vBusinessName)
            ->info()
            ->body(ucfirst(Str::words($advertisement->ad_title, 8, '...')))
            ->actions([
                Action::make('markAsUnread')
                    ->button()
                    ->markAsRead(),
                Action::make('View')->url(function () use ($adId) {
                    return route('advertisements.adpreview', [$adId]);
                }),
                Action::make('Edit')->url(function () use ($adId) {
                    return url(env('APP_URL').'/admin/advertisements/' . $adId . '/edit');
                }),
            ])
            ->sendToDatabase($adminDetails);
        }
    }

    /**
     * Handle the Advertisement "updated" event.
     */
    public function updated(Advertisement $advertisement): void
    {
        // dd($advertisement->approrval_status);
        $vendorDetails = User::where('id', $advertisement->v_id)->get();
        $approrval = $advertisement->approrval_status;
        $adId = $advertisement->id;

        if(Auth::user()->role_id == 1 && $approrval == 'rejected'){
            Notification::make()
            ->title('Your Advertisement Has Rejected. ')
            ->info()
                ->body(ucfirst(Str::words($advertisement->ad_title, 8, '...')))
                ->actions([
                    Action::make('markAsUnread')
                        ->button()
                        ->markAsRead(),
                    Action::make('View')->url(function () use ($adId) {
                        return route('advertisements.adpreview', [$adId]);
                    }),
                ])
                ->sendToDatabase($vendorDetails);
        }

        if(Auth::user()->role_id == 1 && $approrval == 'reviewing'){
            // dd($advertisement);
            Notification::make()
            ->title('Your Advertisement Under Reviewing. ')
            ->info()
            ->body(ucfirst(Str::words($advertisement->ad_title, 8, '...')))
            ->actions([
                Action::make('markAsUnread')
                    ->button()
                    ->markAsRead(),
                Action::make('View')->url(function () use ($adId) {
                    return route('advertisements.adpreview', [$adId]);
                }),
            ])
            ->sendToDatabase($vendorDetails);
        }

        if(Auth::user()->role_id == 1 && $approrval == 'pending_approval'){
            Notification::make()
            ->title('Your Advertisement is still not getting approval. ')
            ->info()
                ->body(ucfirst(Str::words($advertisement->ad_title, 8, '...')))
                ->actions([
                    Action::make('markAsUnread')
                        ->button()
                        ->markAsRead(),
                    Action::make('View')->url(function () use ($adId) {
                        return route('advertisements.adpreview', [$adId]);
                    }),
                ])
                ->sendToDatabase($vendorDetails);
        }

        if (Auth::user()->role_id == 1 && $approrval == 'published') {
            Notification::make($adId)
                ->title('Your Advertisement has been Published.')
                ->success()
                ->body(ucfirst(Str::words($advertisement->ad_title, 8, '...')))
                ->actions([
                    Action::make('markAsUnread')
                        ->button()
                        ->markAsRead(),
                    Action::make('View')->url(function () use ($adId) {
                        return route('advertistments.show', [$adId]);
                    }),
                ])
                ->sendToDatabase($vendorDetails);
        }







    }

    /**
     * Handle the Advertisement "deleted" event.
     */
    public function deleted(Advertisement $advertisement): void
    {
        //
    }

    /**
     * Handle the Advertisement "restored" event.
     */
    public function restored(Advertisement $advertisement): void
    {
        //
    }

    /**
     * Handle the Advertisement "force deleted" event.
     */
    public function forceDeleted(Advertisement $advertisement): void
    {
        //
    }
}
