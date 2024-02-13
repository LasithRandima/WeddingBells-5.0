<?php

namespace App\Http\Controllers;

use App\Models\ClientWishlist;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\ClientWishlist  $clientWishlist
     * @return \Illuminate\Http\Response
     */
    public function show(ClientWishlist $clientWishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientWishlist  $clientWishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientWishlist $clientWishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientWishlist  $clientWishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientWishlist $clientWishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientWishlist  $clientWishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientWishlist $clientWishlist)
    {
        //
    }


    public function addToWishlist(Request $request)
    {
        dd($request->all());
        try {
            $adId = $request->ad_id;
            $actualVId = Auth::id();

            $ad_category = DB::Table('advertisements')->select('category_id')->where('id', $adId)->value('category_id');

            // Check if the advertisement is already in the wishlist
            $wishlistItem = ClientWishlist::where('c_id', Auth::id())
                ->where('ad_id', $adId)
                ->first();

            if (!$wishlistItem) {
                // If not, add it to the wishlist
                ClientWishlist::create([
                    'c_id' => $actualVId,
                    'ad_id' => $adId,
                    'cat_id' => $ad_category,
                ]);

                return response()->json(['message' => 'Advertisement added to wishlist']);
            }

            // return response()->json(['message' => 'Advertisement already in wishlist']);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error adding to wishlist: ' . $e->getMessage());

            // Return a generic error message to the client
            return response()->json(['error' => 'Error adding to wishlist. Please try again.'], 500);
        }
    }


    public function checkWishlist(Request $request)
    {
        try {
            $adId = $request->ad_id;
            $actualVId = Auth::id();

            // Check if the advertisement is in the wishlist
            $wishlistItem = ClientWishlist::where('c_id', $actualVId)
                ->where('ad_id', $adId)
                ->first();

            return response()->json(['in_wishlist' => !!$wishlistItem]);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error checking wishlist: ' . $e->getMessage());

            // Return a generic error message to the client
            return response()->json(['error' => 'Error checking wishlist. Please try again.'], 500);
        }
    }

    public function toggleWishlist(Request $request)
    {
        // dd($request->all());
        try {
            $adId = $request->ad_id;
            $ad_category = DB::Table('advertisements')->select('category_id')->where('id', $adId)->value('category_id');
            $actualVId = Auth::id();

            // Check if the advertisement is already in the wishlist
            $wishlistItem = ClientWishlist::where('c_id', $actualVId)
                ->where('ad_id', $adId)
                ->first();

            if ($wishlistItem) {
                // If the ad is in the wishlist, remove it
                $wishlistItem->delete();
                $message = 'Advertisement removed from wishlist';
            } else {
                // If the ad is not in the wishlist, add it
                ClientWishlist::create([
                    'c_id' => $actualVId,
                    'ad_id' => $adId,
                    'cat_id' => $ad_category,
                ]);
                $message = 'Advertisement Added To wishlist Successfully.';
            }

            return response()->json(['message' => $message]);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error toggling wishlist: ' . $e->getMessage());

            // Return a generic error message to the client
            return response()->json(['error' => 'Error toggling wishlist. Please try again.'], 500);
        }
    }

    public function wishcategories() {
        $allCategories = VendorCategory::all();
        $wishlistAds = ClientWishlist::where('c_id', Auth::id())->get();

        return view('customer.wishlistcategories', compact('wishlistAds','allCategories'));
    }


    public function categoryfavourites($category) {
        $category_name = VendorCategory::where('id', $category)->value('Category_name');
        $categorywishlistAds = ClientWishlist::where('c_id', Auth::id())->where('cat_id', $category)->paginate(10);

        // foreach ($categorywishlistAds as $categorywishlistAd){

        //     $categoryFavouriteTopAd = DB::table('advertisements')->where('id', '=', $categorywishlistAd->ad_id)->where('ad_type', 1)->get();
        //     $normalAd = DB::table('advertisements')->where('id', '=', $categorywishlistAd->ad_id)->where('ad_type', 0)->get();

        //     dd($categoryFavouriteTopAd);
        // }





        // $categoryFavouriteTopAds = DB::table('advertisements')->where('category_id', '=', $category)->where('ad_type', 1)->get();
        // $categoryFavouriteNormalAds = DB::table('advertisements')->where('category_id', '=', $category)->where('ad_type', 0)->get();
        // dd($categoryFavouriteTopAds);

        // return view('customer.categorywishlist', compact('categorywishlistAds', 'category_name', 'categoryFavouriteTopAds', 'categoryFavouriteNormalAds'));
        return view('customer.categorywishlist', compact('categorywishlistAds', 'category_name'));
    }


//     public function addToWishlist(Request $request)
// {
//     dd($request);
//     $adId = $request->input('ad_id');

//     // Check if the advertisement is already in the wishlist
//     $wishlistItem = ClientWishlist::where('c_id', auth()->user()->id)
//         ->where('ad_id', $adId)
//         ->first();

//     if (!$wishlistItem) {
//         // If not, add it to the wishlist
//         ClientWishlist::create([
//             'c_id' => auth()->user()->id,
//             'ad_id' => $adId,
//         ]);

//         return response()->json(['message' => 'Advertisement added to wishlist']);
//     }

//     return response()->json(['message' => 'Advertisement already in wishlist']);
// }



}
