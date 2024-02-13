<?php

namespace App\Http\Controllers;

use App\Models\TopAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopAdController extends Controller
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
     * @param  \App\Models\TopAd  $topAd
     * @return \Illuminate\Http\Response
     */
    public function show(TopAd $topAd)
    {
        // $topAd = TopAd::findOrFail($topAd);
        // dd($topAd);
        $vendorId= DB::table('top_ads')->select('v_id')->where('id', '=', $topAd->id)->value('v_id');
        // $vendorAds = DB::table('top_ads')->where('v_id', '=', $vendorId);
        $vendorAds = TopAd::where('v_id', $vendorId)->take(10)->get();
        // dd($vendorAds);
        return view('common.vendorposts', compact('topAd', 'vendorAds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopAd  $topAd
     * @return \Illuminate\Http\Response
     */
    public function edit(TopAd $topAd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopAd  $topAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopAd $topAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopAd  $topAd
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopAd $topAd)
    {
        //
    }
}
