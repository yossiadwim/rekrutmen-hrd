<?php

namespace App\Http\Controllers;

use App\Models\TesTertulis;
use Illuminate\Http\Request;

class TesTertulisController extends Controller
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
     * @param  \App\Models\TesTertulis  $tesTertulis
     * @return \Illuminate\Http\Response
     */
    public function show(TesTertulis $tesTertulis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TesTertulis  $tesTertulis
     * @return \Illuminate\Http\Response
     */
    public function edit(TesTertulis $tesTertulis)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TesTertulis  $tesTertulis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TesTertulis $tesTertulis)
    {
        dd($request, $tesTertulis);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TesTertulis  $tesTertulis
     * @return \Illuminate\Http\Response
     */
    public function destroy(TesTertulis $tesTertulis)
    {
        //
    }
}
