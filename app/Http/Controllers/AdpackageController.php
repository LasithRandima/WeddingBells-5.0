<?php

namespace App\Http\Controllers;

use App\Models\Adpackage;
use App\Http\Requests\StoreAdpackageRequest;
use App\Http\Requests\UpdateAdpackageRequest;

class AdpackageController extends Controller
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
     * @param  \App\Http\Requests\StoreAdpackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdpackageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adpackage  $adpackage
     * @return \Illuminate\Http\Response
     */
    public function show(Adpackage $adpackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adpackage  $adpackage
     * @return \Illuminate\Http\Response
     */
    public function edit(Adpackage $adpackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdpackageRequest  $request
     * @param  \App\Models\Adpackage  $adpackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdpackageRequest $request, Adpackage $adpackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adpackage  $adpackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adpackage $adpackage)
    {
        //
    }
}
