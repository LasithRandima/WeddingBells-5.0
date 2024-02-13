<?php

namespace App\Http\Controllers;

use App\Models\TopAd;
use App\Models\TopAds;
use App\Models\Advertisement;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            // Retrieve search inputs from request
    $vCategory = $request->input('vCategory');
   $vendorName = $request->input('vendorName');


    // Query advertisements with filters
    $advertisementsQuery = Advertisement::query();
    $topAdsQuery = Advertisement::query();

    if ($vCategory && $vendorName) {
        $advertisementsQuery->where('ad_type', 0)->where('category_id', $vCategory)->where(function ($query) use ($vendorName) {
            $query->where('vBusinessName', 'like', '%'.$vendorName.'%');
        });
        $topAdsQuery->where('ad_type', 1)->where('category_id', $vCategory)->where(function ($query) use ($vendorName) {
            $query->where('vBusinessName', 'like', '%'.$vendorName.'%');
        });
    } elseif ($vendorName && $vCategory == null) {
        $advertisementsQuery->where('ad_type', 0)->where(function ($query) use ($vendorName) {
            $query->where('vBusinessName', 'like', '%'.$vendorName.'%');
        });
        $topAdsQuery->where('ad_type', 1)->where(function ($query) use ($vendorName) {
            $query->where('vBusinessName', 'like', '%'.$vendorName.'%');
        });
    } elseif ($vCategory &&$vendorName == null) {
        $advertisementsQuery->where('ad_type', 0)->where('category_id', $vCategory);
        $topAdsQuery->where('ad_type', 1)->where('category_id', $vCategory);
    }

    // Determine which paginator to use
    $paginator = null;
    if (!$vCategory && !$vendorName) {
        $vendorNormalAds = $advertisementsQuery->where('ad_type', 0)->orderBy('id', 'desc')->paginate(5);
        $vendorTopAds = $topAdsQuery->where('ad_type', 1)->orderBy('id', 'desc')->paginate(1);
        $allAds = null;

        $paginator = ($vendorNormalAds->lastPage() > $vendorTopAds->lastPage()) ? $vendorNormalAds : $vendorTopAds;
    } else {
        $allAdsQuery = $advertisementsQuery->unionAll($topAdsQuery);
        $allAds = $allAdsQuery->orderBy('id', 'desc')->paginate(8);

        $vendorNormalAds = $allAds->whereInstanceOf(Advertisement::class);
        $vendorTopAds = $allAds->whereInstanceOf(TopAd::class);
    }

    // Retrieve all categories
    $allCategories = VendorCategory::all();

    // Pass results to view
    return view('common.vendoradsbyname', [
        'vendorNormalAds' => ($vendorNormalAds !== null) ? $vendorNormalAds : [],
        'vendorTopAds' => ($vendorTopAds !== null) ? $vendorTopAds : [],
        'allCategories' => $allCategories,
        'paginator' => $paginator,
        'allAds' => $allAds,
        'vCategory' => $vCategory,
        'vendorName' =>$vendorName,
        'request' => $request,
    ]);
    }

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
    public function show(Advertisement $advertisement)
    {
        //
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
}
