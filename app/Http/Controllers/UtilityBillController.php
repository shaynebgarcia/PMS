<?php

namespace App\Http\Controllers;

use App\Utility;
use App\UtilityBill;
use Illuminate\Http\Request;

class UtilityBillController extends Controller
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

    public function multicreate()
    {
        $utilities = Utility::all();
        return view('pages.utility.multibill-create', compact('utilities'));
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
     * @param  \App\UtilityBill  $utilityBill
     * @return \Illuminate\Http\Response
     */
    public function show(UtilityBill $utilityBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UtilityBill  $utilityBill
     * @return \Illuminate\Http\Response
     */
    public function edit(UtilityBill $utilityBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UtilityBill  $utilityBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UtilityBill $utilityBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UtilityBill  $utilityBill
     * @return \Illuminate\Http\Response
     */
    public function destroy(UtilityBill $utilityBill)
    {
        //
    }
}
