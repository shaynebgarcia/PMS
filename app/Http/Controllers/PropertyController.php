<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Unit;
use App\UnitType;
use Alert;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return view('pages.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'max:255',
            'contact' => 'max:255',
            'floor_total' => 'numeric',
            'unit_total' => 'numeric',
            'date_finish' => 'date',
            'date_start_leasing' => 'date',
        ]);

        $store = Property::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'floor_total' => $request->floor_total,
            'unit_total' => $request->unit_total,
            'date_finish' => $request->date_finish,
            'date_start_leasing' => $request->date_start_leasing,
        ]);

        if (!$store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('property.index');
        } else {
            $store_default_unit_type = UnitType::create([
                'property_id' => $store->id,
                'name' => 'N/A',
                'size' => '0sqm',
                'lease_price' => 0,
            ]);
            Alert::success('Created a new property '.'"'.$store->name.'"','Success')->autoclose(2500);
            return redirect()->route('property.show', $store->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->first();
        $unit_types = UnitType::where('property_id', $property->id)->get();
        return view('pages.property.show', compact('property', 'unit_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $property = Property::where('slug', $slug)->first();
        return view('pages.property.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'max:255',
            'address' => 'max:255',
            'contact' => 'max:255',
            'floor_total' => 'numeric',
            'unit_total' => 'numeric',
            'date_finish' => 'date',
            'date_start_leasing' => 'date',
        ]);

        $property = Property::where('slug', $slug)->first();
        $update = $property->update([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'floor_total' => $request->floor_total,
            'unit_total' => $request->unit_total,
            'date_finish' => $request->date_finish,
            'date_start_leasing' => $request->date_start_leasing,
        ]);

        if (!$update) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('property.index');
        } else {
            Alert::success('Updated property '.'"'.$property->name.'"','Success')->autoclose(2500);
            return redirect()->route('property.show', $property->id);
        }

        return redirect()->route('property.show', $property->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
    }
}
