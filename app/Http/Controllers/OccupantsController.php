<?php

namespace App\Http\Controllers;

use App\Occupants;
use Illuminate\Http\Request;

class OccupantsController extends Controller
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
        return view('auth.register-occupant');
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
     * @param  \App\Occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function show(Occupants $occupants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupants $occupants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupants $occupants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupants $occupants)
    {
        //
    }
}
