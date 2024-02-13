<?php

namespace app\Livewire;


use App\Models\Review;
use Illuminate\View\View;
use Livewire\Component;

class AdvertistmentReviewSpecial extends Component
{
    protected $listeners = ['updateReviewGeneral' => 'calculateTotalReviews'];

    public $advertisement;
    public $topAd;
    public int $ad_id;
    // public int $vendorId;
    public $v_id;
    // public int $actualvendorId;
    public $actual_v_id;
    public int $totalReviews;
    public $avgRating;
    public array $ratings = [];

    public function render(): View
    {
        $total = $this->totalReviews;
        Review::query()
            ->selectRaw('rating, count(*) as rating_count')
            ->where('ad_id', $this->ad_id)
            ->orderByDesc('rating')
            ->groupBy('rating')
            ->get()
            ->each(function($group) use ($total) {
				$this->ratings[$group->rating] = round($group->rating_count / $total * 100);
			});

        foreach(range(1, 5) as $rating) {
            if (! array_key_exists($rating, $this->ratings)) {
                $this->ratings[$rating] = 0;
            }
        }

        return view('livewire.advertistment-review-special');
    }

    public function calculateTotalReviews()
    {
        $this->totalReviews++;
        $this->avgRating = Review::query()
            ->where('ad_id', $this->ad_id)
            ->avg('rating');
    }
}
