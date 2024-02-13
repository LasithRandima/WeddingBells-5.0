<?php

namespace App\Http\Controllers;

use App\Models\ClientEventPlanner;
use Illuminate\Http\Request;

class ClientEventPlannerController extends Controller
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
        // dd($request->all());
        $request->validate([
            'clientids' => 'required|Numeric',
            'event' => 'required|string',
            'esdate' => 'required|date',
            'end_date' => 'required|date',
            'etime' => 'nullable',
            'rperson' => 'nullable',
        ]);

        ClientEventPlanner::create([
            'c_id' => $request->clientids,
            'event_title' => $request->event,
            'event_desc' => $request->eventdesc,
            'event_start_date' => $request->esdate,
            'event_end_date' => $request->end_date,
            'event_start_time' => $request->etime,
            'responsible_person' => $request->rperson,
        ]);

        return redirect()->route('customer.calendar.index')->with('success','Event created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientEventPlanner  $clientEventPlanner
     * @return \Illuminate\Http\Response
     */
    public function show(ClientEventPlanner $clientEventPlanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientEventPlanner  $clientEventPlanner
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientEventPlanner $clientEventPlanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientEventPlanner  $clientEventPlanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientEventPlanner $clientEventPlanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientEventPlanner  $clientEventPlanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientEventPlanner $clientEventPlanner)
    {
        //
    }
}
