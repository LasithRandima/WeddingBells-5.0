<?php

namespace App\Http\Controllers;

use App\Models\ClientEventPlanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $clientevents = ClientEventPlanner::where('c_id', Auth::id())->get();
        foreach($clientevents as $clientevent){
            $events[] =[
                'id' => $clientevent->id,
                'title' => $clientevent->event_title,
                'event_desc'    => $clientevent->event_desc,
                'start' => $clientevent->event_start_date,
                'end' => $clientevent->event_end_date,
                'event_start_time' => $clientevent->event_start_time,
                'responsible_person' => $clientevent->responsible_person,
            ];

        }

        return view('customer.calendar.index', ['events' => $events]);
    }


    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
        ]);

        $clientevent = ClientEventPlanner::create([
            // 'c_id' => Auth::id(),
            'c_id' => $request->cid,
            'event_title' => $request->title,
            'event_desc' => $request->edes,
            'event_start_date' => $request->start_date,
            'event_end_date' => $request->end_date,
            'event_start_time' => $request->etime,
            'responsible_person' => $request->eperson,

        ]);

        return response()->json($clientevent);
    }


    public function update(Request $request, $id) {
       $clientevent = ClientEventPlanner::find($id);
       if(! $clientevent){
        return response()->json([
            'error' => 'Unable to find client event'
        ], 404);
       }
       $clientevent->update([
        'event_start_date' => $request->start_date,
        'event_end_date' => $request->end_date,
       ]);
       return response()->json('Event updated');
    }


    public function destroy($id)
    {
        $clientevent = ClientEventPlanner::find($id);
        if(! $clientevent){
            return response()->json([
                'error' => 'Unable to find client event'
            ], 404);
           }

        $clientevent->delete();
        return $id;
    }


    
}
