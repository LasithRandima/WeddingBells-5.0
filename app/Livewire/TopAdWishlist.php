<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class TopAdWishlist extends Component
{
    public $adId;
    public $clientId;
    public $topadwishlist;
    public $ad_category;
    protected $listeners = ['wishlisttoggling'];




    public function mount($adId, $clientId)
    {
        $this->adId = $adId;
        $this->clientId = $clientId;
        $this->ad_category = DB::Table('advertisements')->select('category_id')->where('id', $adId)->value('category_id');
        $this->topadwishlist = DB::table('client_wishlists')
        ->where('ad_id', $this->adId)
        ->where('c_id', Auth::id())
        ->first();
    }

    public function toggleWishlist()
    {
        $this->topadwishlist = DB::table('client_wishlists')
            ->where('ad_id', $this->adId)
            ->where('c_id', Auth::id())
            ->first();

        if ($this->topadwishlist) {
            DB::table('client_wishlists')
                ->where('ad_id', $this->adId)
                ->where('c_id', Auth::id())
                ->delete();

            // Notification::make()
            //     ->title('Advertisement Removed From Wishlist.')
            //     ->seconds(5)
            //     ->danger()
            //     ->send();

            $message = 'Advertisement Removed From Wishlist.';
            $this->dispatch('toastrtopad:error', ['message' => $message]);
            $this->dispatch('wishlisttoggling');

        } else {
            DB::table('client_wishlists')->insert([
                'ad_id' => $this->adId,
                'c_id' => Auth::id(),
                'cat_id' => $this->ad_category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Notification::make()
            // ->title('Advertisement Added To Wishlist.')
            // ->seconds(5)
            // ->success()
            // ->send();

            $message = 'Advertisement Added To Wishlist.';
            $this->dispatch('toastrtopad:info', ['message' => $message]);
            $this->dispatch('wishlisttoggling');
        }

    }


    public function wishlisttoggling()
    {
        $this->topadwishlist = DB::table('client_wishlists')
            ->where('ad_id', $this->adId)
            ->where('c_id', Auth::id())
            ->first();
    }


    public function render()
    {
        return view('livewire.top-ad-wishlist',['topadwishlist' => $this->topadwishlist]);
    }
}
