<?php

namespace App\Http\Controllers;

use App\Models\AllGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RsvpMail;

class AllGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.guestlistrsvpmail', [
            'allGuests' => AllGuest::all(),
        ]);
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
    public function show(AllGuest $allGuest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AllGuest $allGuest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllGuest $allGuest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AllGuest $allGuest)
    {
        //
    }


    public function rsvpguestlistshare($user_id)
    {
        // dd($user_id);
        $clientId = $user_id;
        $client = DB::table('clients')->where('user_id', $clientId)->get();
        $clientGuests = DB::table('all_guests')->where('c_id', $clientId)->whereNotNull('email')->where(DB::raw('json_length(invited_to)'), '>', 0)->get();
        // dd($client);
        return view('customer.guestlistrsvpmail', [
            'allGuests' => AllGuest::all(),
            'clientId' => $clientId,
            'client' => $client,
            'clientGuests' => $clientGuests,
        ]);
    }

    public function rsvprequestmail(Request  $request){


        // $request->validate([
        //     'package' => 'required|numeric',
        //     'event_date' => 'required|after_or_equal:today',
        //     'event_start_time' => 'required',
        // ]);


        // ClientVendorBooking::where('id', $id)->update([
        //     'pkg_id' => $request->package,
        //     'event_date' => $request->event_date,
        //     'event_start_time' => $request->event_start_time,
        //     'event_end_time' => $request->event_end_time,
        //     'booking_status' => 'booked',
        // ]);

        // return redirect()->route('clientBookings.index')->with('success', 'Booked successfully.');
    }


    public function sendRSVP(Request $request)
    {
        $guestIds = $request->input('guestids');
        $inviteMsg = $request->input('invite_msg');
        $is_invited = $request->input('is_invited');

        // dd($request->all());
        foreach ($guestIds as $guestId) {

            $email = DB::table('all_guests')->select('email')->where('id', $guestId)->value('email');
            $clientid = DB::table('all_guests')->select('c_id')->where('id', $guestId)->value('c_id');
            $wedding_date = DB::table('clients')->select('wed_date')->where('user_id', $clientid)->value('wed_date');
            $wedding_start_time = DB::table('clients')->select('wed_start_time')->where('user_id', $clientid)->value('wed_start_time');

            $client_name = DB::table('clients')->select('c_name')->where('user_id', $clientid)->value('c_name');
            $partner_name = DB::table('clients')->select('partner_name')->where('user_id', $clientid)->value('partner_name');

            // dd($clientid);
            // Send email to each guest
            $guest = AllGuest::find($guestId);
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            // $this->sendEmail($guest->email, $inviteMsg);

            $rsvplink = env('APP_URL').'/rsvpsearched';



            // return route('rsvpguestlist.rsvpguestlistshare', [Auth::id()]);
             Mail::to($email)->send(new RsvpMail($rsvplink, $inviteMsg, $client_name, $partner_name, $wedding_date, $wedding_start_time));

            // Update invite_msg for each guest
            $guest->update(['invite_msg' => $inviteMsg, 'mail_sent_at' => $current_time, 'mail_status' => 'send', 'is_invited' => $is_invited]);
        }

        // Additional logic if needed

        return redirect()->back()->with('success', 'RSVPs sent successfully.');
    }


}
