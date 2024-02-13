<?php

namespace App\Http\Controllers;

use App\Models\ClientVendorBooking;
use Illuminate\Http\Request;

use App\Models\TopAd;
use App\Models\Advertisement;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DebugBar\DebugBar;

class ClientBookingController extends Controller
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
                // app('debugbar')->info(auth()->user()->role_id );

                // dd($topadsbookings);
        return view('customer.managebookings', compact('bookings','topadsbookings'));
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
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function show(ClientVendorBooking $clientVendorBooking)
    {
        //
    }

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
        $request->validate([
            'package' => 'required|numeric',
            'event_date' => 'required|after_or_equal:today',
            'event_start_time' => 'required',
        ]);


        $clientVendorBooking->update([
            'pkg_id' => $request->package,
            'event_date' => $request->event_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'booking_status' => 'booked',
        ]);

        return redirect()->route('clientBookings.index')->with('success', 'Booked successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientVendorBooking  $clientVendorBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientVendorBooking $clientVendorBooking)
    {
        //
    }

    // public function packageData(Request $request) {

    //     $topAdId = $request->get('adId');
    //     app('debugbar')->info($topAdId);

    //     $packages = DB::table('adpackages')
    //                 ->join('client_vendor_bookings', 'adpackages.id', '=', 'client_vendor_bookings.pkg_id.pkg_id')
    //                 ->select('adpackages.*', 'client_vendor_bookings.event_date', 'client_vendor_bookings.event_start_time', 'client_vendor_bookings.event_end_time')
    //                 ->where('adpackages.pkg_id', '=', $topAdId)
    //                 ->get();

    //                 dd($packages);
    //     // Return a view with the fetched data
    //     return view('customer.managebookings', compact('packages'));
    // }


    public function packageData($id) {

        $topAdId = ClientVendorBooking::findOrFail($id);

        // $topAdId = $request->get('adId');
        app('debugbar')->info($topAdId);

        $packages = DB::table('adpackages')
                    ->join('client_vendor_bookings', 'adpackages.id', '=', 'client_vendor_bookings.pkg_id.pkg_id')
                    ->select('adpackages.*', 'client_vendor_bookings.event_date', 'client_vendor_bookings.event_start_time', 'client_vendor_bookings.event_end_time')
                    ->where('adpackages.pkg_id', '=', $topAdId)
                    ->get();

                    dd($packages);
        // Return a view with the fetched data
        return view('customer.managebookings', compact('packages'));
    }
}
