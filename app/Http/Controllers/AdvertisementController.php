<?php

namespace App\Http\Controllers;

use App\Models\TopAd;
use App\Models\TopAds;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\SocialNetwork;
use App\Models\Vendor;
use App\Models\VendorCategory;
use App\Models\VendorFaq;
use App\Models\VendorSocial;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     // $vendorNormalAds = Advertisement::orderBy('id','desc')->paginate(5);
    //     // $vendorTopAds = TopAd::orderBy('id','desc')->paginate(1);
    //     // $allCategories = VendorCategory::all();

    //     // return view('common.vendors',['vendorNormalAds' => $vendorNormalAds, 'vendorTopAds' => $vendorTopAds, 'allCategories' => $allCategories]);

    //       // Retrieve search inputs from request
    // $category = $request->input('category');
    // $location = $request->input('location');

    // // Query advertisements with filters
    // $advertisementsQuery = Advertisement::query();
    // $topAdsQuery = TopAd::query();
    // if ($category && $location) {
    //     $advertisementsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');;
    //     $topAdsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');;
    //     };

    // if ($location && $category == null) {
    //     $advertisementsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //     $topAdsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    // }

    // if ($category && $location == null) {
    //     $vendorNormalAds = $advertisementsQuery->where('category_id', $category);
    //     $topAdsQuery->where('category_id', $category);
    // }

    // if($category == null && $location == null) {
    //     $vendorNormalAds = $advertisementsQuery->orderBy('id','desc')->paginate(5);
    //     $vendorTopAds = $topAdsQuery->orderBy('id','desc')->paginate(1);
    // }

    // // Retrieve paginated results
    // // $vendorNormalAds = $advertisementsQuery->orderBy('id','desc')->paginate(5);
    // // $vendorTopAds = $topAdsQuery->orderBy('id','desc')->paginate(1);
    // // $vendorNormalAds = $advertisementsQuery->orderBy('id','desc')->paginate(5);
    // // $vendorTopAds = $topAdsQuery->orderBy('id','desc')->paginate(1);

    // $pagination = $vendorNormalAds->lastPage() >= $vendorTopAds->lastPage() ? $vendorNormalAds : $vendorTopAds;
    // // if($vendorNormalAds->lastPage() && $vendorTopAds->lastPage()){
    // //     $pagination = $vendorNormalAds->lastPage() >= $vendorTopAds->lastPage() ? $vendorNormalAds : $vendorTopAds;
    // // }


    // $allCategories = VendorCategory::all();

    // // Pass results to view
    // return view('common.vendors', [
    //     'vendorNormalAds' => $vendorNormalAds,
    //     'vendorTopAds' => $vendorTopAds,
    //     'allCategories' => $allCategories,
    //     'pagination' => $pagination,
    // ]);
    // }




    // public function index(Request $request)
    // {
    //     // Retrieve search inputs from request
    //     $category = $request->input('category');
    //     $location = $request->input('location');

    //     // Query advertisements with filters
    //     $advertisementsQuery = Advertisement::query();
    //     $topAdsQuery = TopAd::query();

    //     if ($category && $location) {
    //         $advertisementsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($location && $category == null) {
    //         $advertisementsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($category && $location == null) {
    //         $advertisementsQuery->where('category_id', $category);
    //         $topAdsQuery->where('category_id', $category);
    //     }

    //     // Determine which paginator to use
    //     $paginator = null;
    //     if (!$category && !$location) {
    //         $vendorNormalAds = $advertisementsQuery->orderBy('id', 'desc')->paginate(5);
    //         $vendorTopAds = $topAdsQuery->orderBy('id', 'desc')->paginate(1);

    //         $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
    //     } else {
    //         $vendorNormalAds = ($category || $location) ? $advertisementsQuery->orderBy('id', 'desc')->get() : null;
    //         $vendorTopAds = ($category || $location) ? $topAdsQuery->orderBy('id', 'desc')->get() : null;
    //     }

    //     // Retrieve all categories
    //     $allCategories = VendorCategory::all();

    //     // Pass results to view
    //     return view('common.vendors', [
    //         'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
    //         'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
    //         'allCategories' => $allCategories,
    //         'paginator' => $paginator,
    //     ]);
    // }





    // public function index(Request $request)  //workingggggggggggggggggg
    // {
    //     // Retrieve search inputs from request
    //     $category = $request->input('category');
    //     $location = $request->input('location');

    //     // Query advertisements with filters
    //     $advertisementsQuery = Advertisement::query();
    //     $topAdsQuery = TopAd::query();

    //     if ($category && $location) {
    //         $advertisementsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($location && $category == null) {
    //         $advertisementsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($category && $location == null) {
    //         $advertisementsQuery->where('category_id', $category);
    //         $topAdsQuery->where('category_id', $category);
    //     }

    //     // Determine which paginator to use
    //     $paginator = null;
    //     if (!$category && !$location) {
    //         $vendorNormalAds = $advertisementsQuery->orderBy('id', 'desc')->paginate(5);
    //         $vendorTopAds = $topAdsQuery->orderBy('id', 'desc')->paginate(1);
    //         $allAds = null;

    //         $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
    //     } else {
    //         $allAdsQuery = $advertisementsQuery->unionAll($topAdsQuery);
    //         $allAds = $allAdsQuery->orderBy('id', 'desc')->paginate(8);

    //         $vendorNormalAds = $allAds->whereInstanceOf(Advertisement::class);
    //         $vendorTopAds = $allAds->whereInstanceOf(TopAd::class);
    //     }

    //     // Retrieve all categories
    //     $allCategories = VendorCategory::all();

    //     // Pass results to view
    //     return view('common.vendors', [
    //         'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
    //         'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
    //         'allCategories' => $allCategories,
    //         'paginator' => $paginator,
    //         'allAds' => $allAds,
    //     ]);
    // }



    // public function index(Request $request)         //works good
    // {
    //     // Retrieve search inputs from request
    //     $category = $request->input('category');
    //     $location = $request->input('location');

    //     // Query advertisements with filters
    //     $advertisementsQuery = Advertisement::query();
    //     $topAdsQuery = TopAd::query();

    //     if ($category && $location) {
    //         $advertisementsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%')->orWhere('v_bus_branches', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($location && $category == null) {
    //         $advertisementsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //         $topAdsQuery->where('v_bus_location', 'like', '%'.$location.'%');
    //     } elseif ($category && $location == null) {
    //         $advertisementsQuery->where('category_id', $category);
    //         $topAdsQuery->where('category_id', $category);
    //     }

    //     // Determine which paginator to use
    //     $paginator = null;
    //     if (!$category && !$location) {
    //         $vendorNormalAds = $advertisementsQuery->orderBy('id', 'desc')->paginate(5);
    //         $vendorTopAds = $topAdsQuery->orderBy('id', 'desc')->paginate(1);
    //         $allAds = null;

    //         $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
    //     } else {
    //         $allAdsQuery = $advertisementsQuery->unionAll($topAdsQuery);
    //         $allAds = $allAdsQuery->orderBy('id', 'desc')->paginate(8);

    //         $vendorNormalAds = $allAds->whereInstanceOf(Advertisement::class);
    //         $vendorTopAds = $allAds->whereInstanceOf(TopAd::class);
    //     }

    //     // Retrieve all categories
    //     $allCategories = VendorCategory::all();

    //     // Pass results to view
    //     return view('common.vendors', [
    //         'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
    //         'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
    //         'allCategories' => $allCategories,
    //         'paginator' => $paginator,
    //         'allAds' => $allAds,
    //         'category' => $category,
    //         'location' => $location,
    //         'request' => $request,
    //     ]);
    // }



    public function index(Request $request)
{
    // Retrieve search inputs from request
    $category = $request->input('category');
    $location = $request->input('location');

    // Query advertisements with filters
    $advertisementsQuery = Advertisement::query();
    $topAdsQuery = Advertisement::query();

    if ($category && $location) {
        $advertisementsQuery->where('category_id', $category)->where('ad_type', 0)->where('approrval_status', 'published')->where(function ($query) use ($location) {
            $query->where('v_bus_location', 'like', '%'.$location.'%')
                  ->orWhereJsonContains('v_bus_branches', $location);
        });
        $topAdsQuery->where('category_id', $category)->where('ad_type', 1)->where('approrval_status', 'published')->where(function ($query) use ($location) {
            $query->where('v_bus_location', 'like', '%'.$location.'%')
                  ->orWhereJsonContains('v_bus_branches', $location);
        });
    } elseif ($location && $category == null) {
        $advertisementsQuery->where('ad_type', 0)->where('approrval_status', 'published')->where(function ($query) use ($location) {
            $query->where('v_bus_location', 'like', '%'.$location.'%')
                  ->orWhereJsonContains('v_bus_branches', $location);
        });
        $topAdsQuery->where('ad_type', 1)->where('approrval_status', 'published')->where(function ($query) use ($location) {
            $query->where('v_bus_location', 'like', '%'.$location.'%')
                  ->orWhereJsonContains('v_bus_branches', $location);
        });
    } elseif ($category && $location == null) {
        $advertisementsQuery->where('category_id', $category)->where('ad_type', 0)->where('approrval_status', 'published');
        $topAdsQuery->where('category_id', $category)->where('ad_type', 1)->where('approrval_status', 'published');
    }

    // Determine which paginator to use
    $paginator = null;
    if (!$category && !$location) {
        $vendorNormalAds = $advertisementsQuery->where('ad_type', 0)->where('approrval_status', 'published')->orderBy('id', 'desc')->paginate(5);
        $vendorTopAds = $topAdsQuery->where('ad_type', 1)->where('approrval_status', 'published')->orderBy('id', 'desc')->paginate(1);
        $allAds = null;

        $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
    } else {
        $allAdsQuery = $advertisementsQuery->unionAll($topAdsQuery);
        $allAds = $allAdsQuery->orderBy('id', 'desc')->paginate(8);

        app('debugbar')->info($allAds);

        $vendorNormalAds = $allAds->whereInstanceOf(Advertisement::class)->where('ad_type', 0)->where('approrval_status', 'published');
        $vendorTopAds = $allAds->whereInstanceOf(Advertisement::class)->where('ad_type', 1)->where('approrval_status', 'published');
    }

    // Retrieve all categories
    $allCategories = VendorCategory::all();

    // Pass results to view
    return view('common.vendors', [
        'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
        'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
        'allCategories' => $allCategories,
        'paginator' => $paginator,
        'allAds' => $allAds,
        'category' => $category,
        'location' => $location,
        'request' => $request,
    ]);
}


//     public function index(Request $request)
// {
//     // Retrieve search inputs from request
//     $category = $request->input('category');
//     $location = $request->input('location');

//     // Query advertisements with filters
//     $advertisementsQuery = Advertisement::query();
//     $topAdsQuery = TopAd::query();

//     if ($category && $location) {
//         $advertisementsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
//         $topAdsQuery->where('category_id', $category)->where('v_bus_location', 'like', '%'.$location.'%');
//     } elseif ($location && $category == null) {
//         $advertisementsQuery->where('v_bus_location', 'like', '%'.$location.'%');
//         $topAdsQuery->where('v_bus_location', 'like', '%'.$location.'%');
//     } elseif ($category && $location == null) {
//         $advertisementsQuery->where('category_id', $category);
//         $topAdsQuery->where('category_id', $category);
//     }

//     // Determine which paginator to use
//     $paginator = null;
//     if (!$category && !$location) {
//         $vendorNormalAds = $advertisementsQuery->orderBy('id', 'desc')->paginate(5);
//         $vendorTopAds = $topAdsQuery->orderBy('id', 'desc')->paginate(1);

//         $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
//     } else {
//         $vendorNormalAds = ($category || $location) ? $advertisementsQuery->orderBy('id', 'desc')->paginate(10) : null;
//         $vendorTopAds = ($category || $location) ? $topAdsQuery->orderBy('id', 'desc')->paginate(1) : null;
//     }

//     // Retrieve all categories
//     $allCategories = VendorCategory::all();

//     // Pass results to view
//     return view('common.vendors', [
//         'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
//         'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
//         'allCategories' => $allCategories,
//         'paginator' => $paginator,
//     ]);
// }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show($advertisement)
    {
        // dd($advertisement);
        $ad = Advertisement::findOrFail($advertisement);
        // $ad = Advertisement::where('id', $advertisement)->get();
        $topAd =  $ad
            ->withAvg('reviews as avg_rating', 'rating')
            ->withCount('reviews as total_reviews')
            ->where('id', $advertisement)
            ->first();
        //   dd($topAd);
        $vendorId= DB::table('advertisements')->select('v_id')->where('id', '=', $advertisement)->value('v_id');
        $vendorBuisnessName= DB::table('advertisements')->select('vBusinessName')->where('id', '=', $advertisement)->value('vBusinessName');
        $actualvendorId= DB::table('advertisements')->select('actual_v_id')->where('id', '=', $advertisement)->value('actual_v_id');

        $vendorAds = Advertisement::where('v_id', $vendorId)->where('approrval_status', 'published')->take(10)->get();
        $vendorFaqs = VendorFaq::where('v_id', $vendorId)->get();
        $vendorSocials = SocialNetwork::where('v_id', $vendorId)->where('is_active', 1)->get();
        $vendor = Vendor::where('id', $actualvendorId)->first();

        $shareComponent = \Share::currentPage()
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram($vendorBuisnessName.' - WeddingBells.lk')
        ->whatsapp('Check Us On WeddingBells.lk')
        ->pinterest()
        ->reddit();

        // dd($vendorSocials);
        app('debugbar')->info($vendorFaqs);
        app('debugbar')->info($vendor);
        app('debugbar')->info($topAd);
        app('debugbar')->info($vendorSocials);
        // return view('common.vendorposts', compact('topAd', 'vendorAds', 'vendor'));
        return view('common.vendoradvertistmentdetails', compact('topAd', 'vendorAds', 'vendor', 'vendorFaqs', 'vendorSocials', 'shareComponent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
    }

    public function adpreview($advertisement)
    {
        // $topAd = Advertisement::findOrFail($advertisement);
        // $vendorId= DB::table('advertisements')->select('v_id')->where('id', '=', $advertisement)->value('v_id');
        // $vendorAds = Advertisement::where('v_id', $vendorId)->where('approrval_status', 'published')->take(10)->get();

        $ad = Advertisement::findOrFail($advertisement);
        // $ad = Advertisement::where('id', $advertisement)->get();
        $topAd =  $ad
            ->withAvg('reviews as avg_rating', 'rating')
            ->withCount('reviews as total_reviews')
            ->where('id', $advertisement)
            ->first();
        //   dd($topAd);
        $vendorId= DB::table('advertisements')->select('v_id')->where('id', '=', $advertisement)->value('v_id');
        $actualvendorId= DB::table('advertisements')->select('actual_v_id')->where('id', '=', $advertisement)->value('actual_v_id');

        $vendorAds = Advertisement::where('v_id', $vendorId)->where('approrval_status', 'published')->take(10)->get();
        $vendorFaqs = VendorFaq::where('v_id', $vendorId)->get();
        $vendorSocials = SocialNetwork::where('v_id', $vendorId)->where('is_active', 1)->get();
        $vendor = Vendor::where('id', $actualvendorId)->first();

        // dd($vendorSocials);
        app('debugbar')->info($vendorFaqs);
        app('debugbar')->info($vendor);
        app('debugbar')->info($topAd);
        app('debugbar')->info($vendorSocials);

        // return view('common.vendorposts', compact('topAd', 'vendorAds'));
        return view('common.vendoradvertistmentdetailsPreview', compact('topAd', 'vendorAds', 'vendor', 'vendorFaqs', 'vendorSocials'));
    }

    public function collagepreview($advertisement)
    {
        // dd($advertisement);
        $ad = Advertisement::findOrFail($advertisement);

        $topAd =  $ad
            ->withAvg('reviews as avg_rating', 'rating')
            ->withCount('reviews as total_reviews')
            ->where('id', $advertisement)
            ->first();
        $vendorId= DB::table('advertisements')->select('v_id')->where('id', '=', $advertisement)->value('v_id');
        $actualvendorId= DB::table('advertisements')->select('actual_v_id')->where('id', '=', $advertisement)->value('actual_v_id');
        return view('common.EditPhotoCollageTemplate', compact('topAd'));
    }

    public function adpublish($advertisement)
    {
        $ad = Advertisement::findOrFail($advertisement);
        // dd($advertisement);
        $ad->update(['approrval_status' => 'published']);
        // return redirect()->route('clientVendorBookings.index')->with('message', 'Booked successfully.');
        return redirect()->route('advertisements.adpreview', $advertisement)->with('message', 'Advertisement Published Successfully.');

    }

    public function adreview($advertisement)
    {
        $ad = Advertisement::findOrFail($advertisement);
        // dd($advertisement);
        $ad->update(['approrval_status' => 'reviewing']);
        // return redirect()->route('clientVendorBookings.index')->with('message', 'Booked successfully.');
        return redirect()->route('advertisements.adpreview', $advertisement)->with('message', 'Set Advertisement under the review Process.');

    }

    public function adreject($advertisement)
    {
        $ad = Advertisement::findOrFail($advertisement);
        // dd($advertisement);
        $ad->update(['approrval_status' => 'rejected']);
        // return redirect()->route('clientVendorBookings.index')->with('message', 'Booked successfully.');
        return redirect()->route('advertisements.adpreview', $advertisement)->with('message', 'Advertisement Rejected Successfully.');

    }

}
