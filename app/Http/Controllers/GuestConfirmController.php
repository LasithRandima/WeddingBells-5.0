<?php

namespace App\Http\Controllers;

use App\Models\AllGuest;
use App\Models\GuestConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GuestConfirmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestConfirm $guestConfirm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuestConfirm $guestConfirm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuestConfirm $guestConfirm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestConfirm $guestConfirm)
    {
        //
    }

    public function showrsvpsearch()
    {
        $searchguests = AllGuest::all();

        return view('customer.rsvpguestsearch', [
            'searchguests' => $searchguests,
        ]);
    }


    public function rsvpsearch(Request $request)
    {
         // Retrieve search inputs from request
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');

        $guests = null;

    if ($first_name && $last_name) {
        // Search for guests with both first and last name
        $guests = AllGuest::where('g_first_name', 'LIKE', "%{$first_name}%")
            ->where('g_last_name', 'LIKE', "%{$last_name}%")
            ->where(DB::raw('json_length(invited_to)'), '>', 0)
            ->get();
    } elseif ($first_name && $last_name == null) {
        // Search for guests with first name
        $guests = AllGuest::where('g_first_name', 'LIKE', "%{$first_name}%")->where(DB::raw('json_length(invited_to)'), '>', 0)
            ->get();
    } elseif ($last_name && $first_name == null) {
        // Search for guests with last name
        $guests = AllGuest::where('g_last_name', 'LIKE', "%{$last_name}%")->where(DB::raw('json_length(invited_to)'), '>', 0)
            ->get();
    }
        // $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->get();
        // dd($guests);

        // showing on debugbar
        app('debugbar')->info($guests);

        return view('customer.rsvpguestsearch', [
            // 'clientGuests' => $clientGuests,
            'guests' => $guests,
            'allguests' => AllGuest::whereNotNull('email')->where(DB::raw('json_length(invited_to)'), '>', 0)
            ,
        ]);
    }


  public function beforeselectguest(){
    return view('customer.rsvpguestconfirm');
  }

  public function selectedguestconfirm($select_id){
    dd($select_id);
    $all_guest_id = $select_id;
    $clientId = DB::table('all_guests')->select('c_id')->where('id', $all_guest_id)->value('c_id');
    $guest_id = DB::table('all_guests')->select('guest_id')->where('id', $all_guest_id)->value('guest_id');
    $client = DB::table('clients')->where('user_id', $clientId)->get();
    $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->get();

    $guestData = DB::table('all_guests')->where('id', $all_guest_id);
    $guestCompanionsData = DB::table('all_guests')->where('guest_id', $guest_id)->where('is_companion', 1);

    $allguestQuery = $guestData->unionAll($guestCompanionsData)->get();

    // dd($allguestQuery);

    return view('customer.rsvpguestconfirm', [
        'all_guest_id' => $all_guest_id,
        'clientId' => $clientId,
        'guestId' => $guest_id,
        'client' => $client,
        'clientGuests' => $clientGuests,
        'guestData' => $guestData->get(),
        'guestCompanionsData' => $guestCompanionsData->get(),
        'allguestQuery' => $allguestQuery,
    ]);
  }


    public function rsvpguestconfirm(Request $request)
    {
        //   dd($request->all());
        // $advertisementsQuery = AllGuest::query();
        // $topAdsQuery = AllGuest::query();


        $all_guest_id = $request->input('selected_guest');
        $clientId = DB::table('all_guests')->select('c_id')->where('id', $all_guest_id)->value('c_id');
        $guest_id = DB::table('all_guests')->select('guest_id')->where('id', $all_guest_id)->value('guest_id');
        $client = DB::table('clients')->where('user_id', $clientId)->get();
        $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->get();

        $guestData = DB::table('all_guests')->where('id', $all_guest_id);
        $guestCompanionsData = DB::table('all_guests')->where('guest_id', $guest_id)->where('is_companion', 1);

        $allguestQuery = $guestData->unionAll($guestCompanionsData)->get();

        // dd($allguestQuery);

        return view('customer.rsvpguestconfirm', [
            'all_guest_id' => $all_guest_id,
            'clientId' => $clientId,
            'guestId' => $guest_id,
            'client' => $client,
            'clientGuests' => $clientGuests,
            'guestData' => $guestData->get(),
            'guestCompanionsData' => $guestCompanionsData->get(),
            'allguestQuery' => $allguestQuery,
        ]);
    }


    // public function rsvpguestform(Request $request){
    //             dd($request->all());
    //             // Validate the incoming request data

    //             $all_guest_id = $request->input('guest_id');
    //             $clientId = DB::table('all_guests')->select('c_id')->where('id', $all_guest_id)->value('c_id');
    //             $guest_id = DB::table('all_guests')->select('guest_id')->where('id', $all_guest_id)->value('guest_id');
    //             $client = DB::table('clients')->where('user_id', $clientId)->get();
    //             $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->get();

    //             $guestData = DB::table('all_guests')->where('id', $all_guest_id);
    //             $guestCompanionsData = DB::table('all_guests')->where('guest_id', $guest_id)->where('is_companion', 1);

    //             $allguestQuery = $guestData->unionAll($guestCompanionsData)->get();


    //         $validatedData = $request->validate([
    //             'c_id' => 'required',
    //             'guest_id' => 'required',
    //             'companion_id' => 'nullable',
    //             'event' => 'required|string',
    //             // 'event' => ['required', Rule::in(['ceremony', 'evening_reception', 'wedding_breakfast', 'other'])],
    //             'meal' => 'required|string',
    //             'attendance_status' => 'required',
    //             'c_is_drink' => 'nullable',
    //         ]);

    //         // Create a new GuestConfirm model instance
    //         $guestConfirm = new GuestConfirm();

    //         // Assign the validated data to the model
    //         $guestConfirm->fill([
    //             'c_id' => $validatedData['c_id'],
    //             'guest_id' => $validatedData['guest_id'],
    //             'companion_id' => $validatedData['companion_id'],
    //             'event' => $validatedData['event'],
    //             'meal' => $validatedData['meal'],
    //             'attendance_status' => $validatedData['attendance_status'],
    //             'c_is_drink' => $request->has('c_is_drink') ? 1 : 0,
    //         ]);

    //         // Save the record to the database
    //         $guestConfirm->save();


    //         // return redirect()->route('rsvpguestconfirmform')
    //         //             ->with('message', 'Saved successfully.');
    //         // return redirect()->back()->with('message', 'Saved successfully.');

    //         return view('customer.rsvpguestconfirm', [
    //             'all_guest_id' => $all_guest_id,
    //             'clientId' => $clientId,
    //             'guestId' => $guest_id,
    //             'client' => $client,
    //             'clientGuests' => $clientGuests,
    //             'guestData' => $guestData->get(),
    //             'guestCompanionsData' => $guestCompanionsData->get(),
    //             'allguestQuery' => $allguestQuery,
    //         ]);
    // }



    public function rsvpguestform(Request $request){
        // dd($request->all());

        $all_guest_id = $request->input('guest_id');
        // dd($loopid);

        $clientId = DB::table('all_guests')->select('c_id')->where('id', $all_guest_id)->value('c_id');

        $guest_id = DB::table('all_guests')->select('guest_id')->where('id', $all_guest_id)->value('guest_id');
        $client = DB::table('clients')->where('user_id', $clientId)->get();
        $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->get();

        $guestData = DB::table('all_guests')->where('id', $all_guest_id);
        $guestCompanionsData = DB::table('all_guests')->where('guest_id', $guest_id)->where('is_companion', 1);

        $allguestQuery = $guestData->unionAll($guestCompanionsData)->get();



        // Check if a record_id is provided
        if ($request->filled('record_id')) {
                    // Validate the incoming request data
            $validatedData = $request->validate([
                'record_id' => 'required|integer',
                'c_id' => 'required',
                'guest_id' => 'required',
                'companion_id' => 'nullable',
                'event' => 'required|string',
                'meal' => 'required|string',
                'attendance_status' => 'required',
                'c_is_drink' => 'nullable',
            ]);

            // dd($request->attendance_status);

            // dd($request->meal);
            // Update existing record
            $recordId = $request->input('record_id');

            $guestConfirm = GuestConfirm::findOrFail($recordId);

            $guestConfirm->update([
                'c_id' => $validatedData['c_id'],
                'guest_id' => $validatedData['guest_id'],
                'companion_id' => $validatedData['companion_id'],
                'event' => $validatedData['event'],
                'meal' => $validatedData['meal'],
                'attendance_status' => $validatedData['attendance_status'],
                'c_is_drink' => $request->has('c_is_drink') ? 1 : 0,
            ]);
        } else {
            // dd($request);
            $event = $request->input('event');
            $loopid = $request->input('loopindex');

            $dynamicKey = "attendance_status_{$event}_{$loopid}";
            $attendance = $request->input($dynamicKey);
            //  dd($attendance);

            $validatedData = $request->validate([
                'c_id' => 'required',
                'guest_id' => 'required',
                'companion_id' => 'nullable',
                'event' => 'required|string',
                // 'event' => ['required', Rule::in(['ceremony', 'evening_reception', 'wedding_breakfast', 'other'])],
                'meal' => 'required|string',
                "attendance_status_{$event}_{$loopid}" => 'required',
                'c_is_drink' => 'nullable',
            ]);

            // dd($validatedData);


            // Create a new GuestConfirm model instance
            $guestConfirm = new GuestConfirm();

            // Assign the validated data to the model
            $guestConfirm->fill([
                'c_id' => $validatedData['c_id'],
                'guest_id' => $validatedData['guest_id'],
                'companion_id' => $validatedData['companion_id'],
                'event' => $validatedData['event'],
                'meal' => $validatedData['meal'],
                'attendance_status' => $validatedData["attendance_status_{$event}_{$loopid}"],
                'c_is_drink' => $request->has('c_is_drink') ? 1 : 0,
            ]);



            // Save the record to the database
            $guestConfirm->save();
        }


        return view('customer.rsvpguestconfirm', [
            'all_guest_id' => $all_guest_id,
            'clientId' => $clientId,
            'guestId' => $guest_id,
            'client' => $client,
            'clientGuests' => $clientGuests,
            'guestData' => $guestData->get(),
            'guestCompanionsData' => $guestCompanionsData->get(),
            'allguestQuery' => $allguestQuery,
        ]);
    }
}
