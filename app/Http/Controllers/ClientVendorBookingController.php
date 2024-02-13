<?php

namespace App\Http\Controllers;

use App\Models\TopAd;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\ClientVendorBooking;
use Illuminate\Support\Facades\Auth;
use DebugBar\DebugBar;

class ClientVendorBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('client_vendor_bookings')
                        ->join('advertisements', function ($join) {
                            $join->on('client_vendor_bookings.ad_id', '=', 'advertisements.id')
                                ->where('ad_type', '=', 0)
                                ->where('c_id', '=', Auth::user()->id);
                        })
                        ->select('client_vendor_bookings.*', 'advertisements.ad_title', 'advertisements.ad_title', 'advertisements.about', 'advertisements.ad_image', 'advertisements.vBusinessName')
                        ->get();



        $topadsbookings = DB::table('client_vendor_bookings')
                        ->join('advertisements', function ($join) {
                            $join->on('client_vendor_bookings.ad_id', '=', 'advertisements.id')
                                ->where('ad_type', '=', 1)
                                ->where('c_id', '=', Auth::user()->id);
                        })
                        ->select('advertisements.*', 'client_vendor_bookings.*')
                        ->get();

                        app('debugbar')->info($bookings);
                        app('debugbar')->info(auth()->user()->role_id );

                        // dd($topadsbookings);
        return view('customer.manageclientbookings', compact('bookings','topadsbookings'));
        // return view('customer.managebookings', compact('bookings','topadsbookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common.vendorbooking');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        // dd($request->all());

        $request->validate([
            'c_id' => 'required|numeric',
            'ad_id' => 'nullable|numeric',
            // 'top_ad_id' => 'nullable|numeric',
            'ad_vid' => 'required|numeric',
            'categoryid' => 'required|numeric',
            // 'top_ad_vid' => 'nullable|numeric',
            'cName' => 'required|string',
            'cEmail' => 'required|email',
            // 'cPhone' => ['nullable', 'string', 'regex:/^\+?\d{8,14}$/'], // Valid phone number format
            'cMessage' => 'nullable|string',
            'cEventDate' => 'required|date',
            'cEventStartTime' => 'nullable|date_format:H:i:s',
            'cEventEndTime' => 'nullable|date_format:H:i:s|after:cEventStartTime',
        ]);


        ClientVendorBooking::create([
            'c_id' => $request->c_id,
            'ad_id' => $request->ad_id,
            // 'top_ad_id' => $request->top_ad_id,
            'v_id' => $request->ad_vid,
            'categoryid' => $request->categoryid,
            // 'top_ad_vid' => $request->top_ad_vid,
            'c_name' => $request->cName,
            'c_email' => $request->cEmail,
            'c_tpno' => $request->cPhone,
            'message' => $request->cMessage,
            'event_date' => $request->cEventDate,
            'event_start_time' => $request->cEventStartTime,
            'event_end_time' => $request->cEventEndTime,
            'booking_status' => 'pending',
        ]);
        // ClientVendorBooking::create($request->all());

        // return $response;

        return redirect()->route('clientVendorBookings.index')->with('message','Booking Request send successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function show($clientVendorBooking)
    {

        $vendorNormalAds = Advertisement::where('id', $clientVendorBooking)->get();
        $vendorTopAds = TopAd::where('id', $clientVendorBooking)->get();
        $mergedAds = $vendorNormalAds->merge($vendorTopAds);


        $advertisementsVendorId= DB::table('advertisements')->select('actual_v_id')->where('id', '=', $clientVendorBooking)->value('actual_v_id');
        $topAdsVendorId= DB::table('top_ads')->select('actual_v_id')->where('id', '=', $clientVendorBooking)->value('actual_v_id');
        $ad_category = DB::Table('advertisements')->select('category_id')->where('id', $clientVendorBooking)->value('category_id');
        return view('common.vendorbooking', compact('mergedAds','advertisementsVendorId','topAdsVendorId','clientVendorBooking','ad_category'));
    }

    // public function show(ClientVendorBooking $clientVendorBooking)
    // {
    //     return "helloooooooooooo";
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientVendorBooking $clientVendorBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientVendorBooking $clientVendorBooking)
    {
        $clientVendorBooking->update(['booking_status' => 'cancelled']);

        // Redirect back to the index page with a success message
        return redirect()->route('topAds.index')->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientVendorBooking $clientVendorBooking)
    {
        $clientVendorBooking->delete();
        return redirect()->route('clientVendorBookings.index')->with('message','Booking has been deleted successfully');
    }


    public function cancel(ClientVendorBooking $clientVendorBooking)
    {
        // Update the booking status to 'cancelled'
        $clientVendorBooking->update(['booking_status' => 'cancelled']);

        // Redirect back to the index page with a success message
        return redirect()->route('topAds.index')->with('success', 'Booking cancelled successfully.');
    }
}
