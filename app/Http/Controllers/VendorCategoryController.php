<?php

namespace App\Http\Controllers;

use App\Models\TopAd;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\VendorCategory;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCategories = VendorCategory::all();
        return view('common.categories', compact('allCategories'));
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
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function show(VendorCategory $vendorCategory, Request $request)
    {
        // return $vendorCategory->id;

        $category = $request->input('category');
        $location = $request->input('location');

        // Query advertisements with filters
        $advertisementsQuery = Advertisement::query();
        $topAdsQuery = Advertisement::query();

        if ($category && $location) {
            $advertisementsQuery->where('ad_type', 0)->where('category_id', $category)->where(function ($query) use ($location) {
                $query->where('v_bus_location', 'like', '%'.$location.'%')
                      ->orWhereJsonContains('v_bus_branches', $location);
            });
            $topAdsQuery->where('ad_type', 1)->where('category_id', $category)->where(function ($query) use ($location) {
                $query->where('v_bus_location', 'like', '%'.$location.'%')
                      ->orWhereJsonContains('v_bus_branches', $location);
            });
        } elseif ($category && $location == null) {
            $advertisementsQuery->where('ad_type', 0)->where('category_id', $category);
            $topAdsQuery->where('ad_type', 1)->where('category_id', $category);
        }

        // Determine which paginator to use
        $paginator = null;
        if (!$category && !$location) {
            $vendorNormalAds = $advertisementsQuery->where('ad_type', 0)->where('category_id', $vendorCategory->id)->orderBy('id', 'desc')->paginate(5);
            $vendorTopAds = $topAdsQuery->where('ad_type', 1)->where('category_id', $vendorCategory->id)->orderBy('id', 'desc')->paginate(1);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorCategory $vendorCategory)
    {
        //
    }
}
