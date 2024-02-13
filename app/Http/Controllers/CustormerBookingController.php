<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientVendorBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DebugBar\DebugBar;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Query\Builder;

class CustormerBookingController extends Controller
{
    public function packageData($id)
    {
        $ad_id = $id;
        // dd($id);
        // $topAdId = ClientVendorBooking::findOrFail($id-1);

        // $topAdId = $request->get('adId');


        // $packages = DB::table('advertisements')
        //             ->join('client_vendor_bookings', 'advertisements.id', '=', 'client_vendor_bookings.ad_id')
        //             ->join('adpackages', 'advertisements.id', '=', 'adpackages.ad_id')
        //             ->select('adpackages.*', 'client_vendor_bookings.event_date', 'client_vendor_bookings.event_start_time', 'client_vendor_bookings.event_end_time','advertisements.ad_image')
        //             ->where('advertisements.id', '=', $ad_id)
        //             ->get();


        $packages = DB::table('client_vendor_bookings')
        ->join('advertisements', 'client_vendor_bookings.ad_id', '=', 'advertisements.id')
        ->join('adpackages', 'client_vendor_bookings.ad_id', '=', 'adpackages.ad_id')
        ->select('adpackages.*','client_vendor_bookings.event_date', 'client_vendor_bookings.event_start_time', 'client_vendor_bookings.event_end_time','advertisements.ad_image','advertisements.ad_title')
        ->where('client_vendor_bookings.ad_id', '=', $ad_id)
        ->get();

                    // dd($packages);

                    app('debugbar')->info( $packages);
        // Return a view with the fetched data
        // return view('customer.managebookings', compact('packages'));
        //  return view('vendor.vendorPackages', compact('packages'));

        return response()->json($packages);

        //  // Fetch all records
        //  $userData['data'] = $packages;

        //  echo json_encode($userData);
        //  exit;
    }



    public function bookingData($id)
    {
        $ad_id = $id;

        $advertistmentData = DB::table('advertisements')
            ->select('advertisements.ad_image', 'advertisements.ad_title')
            ->where('advertisements.id', '=', $ad_id)
            ->get()
            ->toArray();

        $packages = DB::table('advertisements')
            ->join('adpackages', 'adpackages.ad_id', '=', 'advertisements.id')
            ->select('adpackages.id','adpackages.pkg_name','adpackages.pkg_description','adpackages.price','adpackages.ad_id','adpackages.v_bus_name', 'advertisements.ad_image', 'advertisements.ad_title')
            ->where('advertisements.id', '=', $ad_id)
            ->get()
            ->toArray();



        $bookingData = DB::table('client_vendor_bookings')
            ->select('client_vendor_bookings.id','client_vendor_bookings.ad_id','client_vendor_bookings.pkg_id','client_vendor_bookings.event_date', 'client_vendor_bookings.event_start_time', 'client_vendor_bookings.event_end_time', 'client_vendor_bookings.booking_status')
            ->where('client_vendor_bookings.ad_id', '=', $ad_id)
            ->get()
            ->toArray();

        // Combine the two result sets using a union
        $combinedData = array_merge($packages, $bookingData, $advertistmentData);

        // Convert the combined array back to a collection if needed
        $combinedDataCollection = collect($combinedData);

        app('debugbar')->info($combinedDataCollection);

        return response()->json($combinedDataCollection);
    }




    // public function bookingData($id)
    // {
    //     $ad_id = $id;

    //     $packagesSubquery = DB::table('adpackages')
    //         ->join('advertisements', 'adpackages.ad_id', '=', 'advertisements.id')
    //         ->select(
    //             'adpackages.id',
    //             'adpackages.pkg_name',
    //             'adpackages.pkg_description',
    //             'adpackages.price',
    //             'adpackages.ad_id',
    //             'adpackages.v_bus_name',
    //             'advertisements.ad_image',
    //             'advertisements.ad_title'
    //         )
    //         ->where('adpackages.ad_id', '=', $ad_id);

    //     $bookingDataSubquery = DB::table('client_vendor_bookings')
    //         ->select(
    //             'client_vendor_bookings.id',
    //             'client_vendor_bookings.ad_id',
    //             'client_vendor_bookings.pkg_id',
    //             'client_vendor_bookings.event_date',
    //             'client_vendor_bookings.event_start_time',
    //             'client_vendor_bookings.event_end_time'
    //         )
    //         ->where('client_vendor_bookings.ad_id', '=', $ad_id);

    //     // Join the subqueries
    //     $combinedData = DB::table(DB::raw("({$packagesSubquery->toSql()}) as packages"))
    //         ->mergeBindings($packagesSubquery)
    //         ->joinSub($bookingDataSubquery, 'booking_data', function ($join) {
    //             $join->on('packages.ad_id', '=', 'booking_data.ad_id');
    //         })
    //         ->get();

    //     app('debugbar')->info($combinedData);

    //     return response()->json($combinedData);
    // }


    // public function bookingData($id)
    // {
    //     $ad_id = $id;

    //     $latestBookings = DB::table('client_vendor_bookings')
    //         ->select('ad_id', 'pkg_id', 'event_date', 'event_start_time', 'event_end_time')
    //         ->where('ad_id', '=', $ad_id);

    //     $combinedData = DB::table('adpackages')
    //         ->join('advertisements', 'adpackages.ad_id', '=', 'advertisements.id')
    //         ->joinSub($latestBookings, 'latest_bookings', function ($join) {
    //             $join->on('adpackages.ad_id', '=', 'latest_bookings.ad_id');
    //         })
    //         ->select(
    //             'adpackages.id',
    //             'adpackages.pkg_name',
    //             'adpackages.pkg_description',
    //             'adpackages.price',
    //             'adpackages.ad_id',
    //             'adpackages.v_bus_name',
    //             'advertisements.ad_image',
    //             'advertisements.ad_title',
    //             'latest_bookings.pkg_id',
    //             'latest_bookings.event_date',
    //             'latest_bookings.event_start_time',
    //             'latest_bookings.event_end_time',

    //         )
    //         ->where('adpackages.ad_id', '=', $ad_id)
    //         ->get();

    //     app('debugbar')->info($combinedData);

    //     return response()->json($combinedData);
    // }


    public function updatebooking(Request  $request, $id)
    {
        // dd($request);
            // Post::where('id', $id)->update([
        //     'title' => $request->title,
        //     'except' => $request->except,
        //     'body' => $request->body,
        //     'image_path' => $request->image,
        //     'is_published' => $request->is_published === 'on',
        //     'min_to_read' => $request->min_to_read
        // ]);


        // $request->validate([
        //     'title' => 'required|max:255|unique:posts,title,'.$id,
        //     'except' => 'required',
        //     'body' => 'required',
        //     'image' => ['mimes:jpg,png,jpeg', 'max:5048'],
        //     'min_to_read' => 'required|min:0|max:60'
        // ]);


        $request->validate([
            'package' => 'required|numeric',
            'event_date' => 'required|after_or_equal:today',
            'event_start_time' => 'required',
        ]);


        ClientVendorBooking::where('id', $id)->update([
            'pkg_id' => $request->package,
            'event_date' => $request->event_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'booking_status' => 'booked',
        ]);

        return redirect()->route('clientBookings.index')->with('success', 'Booked successfully.');
    }
}
