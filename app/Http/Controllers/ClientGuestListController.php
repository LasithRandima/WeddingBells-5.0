<?php

namespace App\Http\Controllers;

use App\Models\ClientGuestList;
use Illuminate\Http\Request;

class ClientGuestListController extends Controller
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
     * @param  \App\Models\ClientGuestList  $clientGuestList
     * @return \Illuminate\Http\Response
     */
    public function show(ClientGuestList $clientGuestList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientGuestList  $clientGuestList
     * @return \Illuminate\Http\Response
     */
    // public function edit(ClientGuestList $clientGuestList)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientGuestList  $clientGuestList
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, ClientGuestList $clientGuestList)
    // {
    //     return $clientGuestList;
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientGuestList  $clientGuestList
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ClientGuestList $clientGuestList)
    // {
    //     return $clientGuestList;
    // }



    // public function edit(): bool
    // {
    //     return true;
    // }

    // public function destroy($id)
    // {
    //     ClientGuestList::query()->find($id)->delete();
    //     return redirect()->route('customer.calendar.index')->with('success','Item has been deleted successfully');
    // }


    // public function bulkdelete($Ids) {
    //     ClientGuestList::query()->whereIn('id', $Ids)->delete();

    // }
}
