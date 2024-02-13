<?php

namespace app\Livewire;


use App\Models\Review;
use Livewire\Component;

class AdvertistmentReviewAverage extends Component
{
    protected $listeners = ['updateAverageRating' => 'calculateAverageRating'];

    public int $adId;
    public $avgRating;

    public function render()
    {
        return view('livewire.advertistment-review-average');
    }

    public function calculateAverageRating()
    {
        $this->avgRating = Review::query()
            ->where('ad_id', $this->adId)
            ->avg('rating');
    }
}
