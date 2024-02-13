<?php

namespace App\Http\Controllers;

use App\Models\SitePackage;
use Illuminate\Http\Request;

class SitePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sitePackages = SitePackage::all();
        return view('admin.sitepackage', compact('sitePackages'));
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
     * @param  \App\Models\SitePackage  $sitePackage
     * @return \Illuminate\Http\Response
     */
    public function show(SitePackage $sitePackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SitePackage  $sitePackage
     * @return \Illuminate\Http\Response
     */
    public function edit(SitePackage $sitePackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SitePackage  $sitePackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SitePackage $sitePackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SitePackage  $sitePackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SitePackage $sitePackage)
    {
        //
    }
}
