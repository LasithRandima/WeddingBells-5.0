<?php

namespace App\Http\Controllers;

use App\Models\GuestList;
use Illuminate\Http\Request;

class GuestListController extends Controller
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
    public function show(GuestList $guestList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuestList $guestList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuestList $guestList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestList $guestList)
    {
        //
    }


    public function guestlinks($userid)
    {
        // $guest = GuestList::findOrFail($userid);
        $guest = $userid;
        // dd($userid);
        return view('livewire.guest-confirm-form', compact('guest'));


        // return redirect()->route('guestlists.guestlinks', $userid)->with('message', 'GuestLinkPage loaded Successfully.');

    }
}
