<?php

namespace app\Livewire;

use App\Models\Advertisement;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdvertistmentReviewsSpecial extends Component
{

    public Advertisement $advertisement;
    public int $totalReviews;
    public int $perPage = 10;

    public $ad_id;
    public $v_id;
    public $actual_v_id;
    public $c_id;
    public $actual_c_id;
    public $rating;
    public $review;
    public $topAd;


    public function mount(Advertisement $advertisement)
    {
        $this->topAd = $advertisement;
        $this->review = '';
        $this->rating = $this->rating;
        $this->ad_id = $this->ad_id;
        $this->c_id = AUTH::id();
        $this->actual_c_id = '';
        $this->v_id = $this->v_id;
        $this->actual_v_id = '';
        $this->advertisement = $advertisement;

        // dd($this->advertisement->id, $this->ad_id, $this->review, $this->rating);
        // // // dd($advertisement);
    }


    protected $rules = [
        // 'ad_id' => 'required|integer',
        // 'ad_id' => 'required|integer',
        // 'c_id' => 'required|integer',
        // 'actual_c_id' => 'required|integer',
        'rating' => 'required|integer|between:1,5',
        'review' => 'required|string|min:3|max:500',
    ];


    public function render(): View
    {
        $reviews = $this->advertisement->users()
            ->take($this->perPage)
            ->get()
            ->map(function ($item) {
                $item->review->percent = $item->review->rating * 20;
                return $item;
            });

        // $reviews = Review::where('ad_id', '=', $this->topAd->id)->take($this->perPage)->get();


            // dd($reviews);

            // $reviews = Review::where('ad_id', '=', $this->topAd->id)
            // ->take($this->perPage)
            // ->get()
            // ->map(function ($item) {
            //     $item->review->percent = $item->review->rating * 20;
            //     return $item;
            // });

        return view('livewire.advertistment-reviews-special', compact('reviews'));
    }

    public function load()
    {
        $this->perPage += 10;
    }

    public function review()
    {
        $this->validate();

        dd($this->advertisement->id, $this->rating, $this->review, auth()->user()->id);

        auth()->user()->advertistmentReviews()->attach(
            $this->advertisement->id, [
                'rating' => $this->rating,
                'review' => $this->review,
        ]);

        $this->totalReviews++;

        $this->reset('rating', 'review');

        $this->dispatch('updateAverageRating');
        $this->dispatch('updateReviewGeneral');
    }



    public function addReview() {
        $create_date_time = Carbon::now()->toDateTimeString();
        // $this->actual_c_id = DB::scalar("select actual_c_id from clients where id = Auth::id()");
        $this->actual_c_id = DB::table('clients')
        ->select('id')
        ->where('user_id', '=', Auth::id())
        ->value('id');
        $this->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|min:3|max:500',
        ]);

        Review::create([
            'ad_id' => $this->topAd->id,
            'v_id' => $this->topAd->v_id,
            'actual_v_id' => $this->topAd->actual_v_id,
            'c_id' => AUTH::id(),
            'actual_c_id' => $this->actual_c_id,
            'review' => $this->review,
            'rating' => $this->rating,
        ]);




        $this->reset('ad_id');
        $this->reset('v_id');
        $this->reset('actual_v_id');
        $this->reset('c_id');
        $this->reset('actual_c_id');
        $this->reset('review');
        $this->reset('rating');



        // $this->listBudgets = DB::table('client_budgets')->where('c_id', '=', AUTH::id())->orderBy('id','DESC')->get();
        // session()->flash('message', 'Budget listed successfully...');

        $this->dispatch('toastr:info', [
            'message' => 'Review Added successfully',
        ]);

        $this->totalReviews++;

        $this->dispatch('updateAverageRating');
        $this->dispatch('updateReviewGeneral');

    }

    public function deleteReview($id)
    {
        $review = Review::find($id);
        $review->delete();


        $this->reset('ad_id');
        $this->reset('v_id');
        $this->reset('actual_v_id');
        $this->reset('c_id');
        $this->reset('actual_c_id');
        $this->reset('review');
        $this->reset('rating');


        $this->dispatch('toastr:info', [
            'message' => 'Review Deleted successfully',
        ]);
        $this->totalReviews--;
        $this->dispatch('updateAverageRating');
        $this->dispatch('updateReviewGeneral');
    }


}
