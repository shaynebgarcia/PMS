<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\UnitType;
use Alert;

class UnitTypeController extends Controller
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
    public function create($id)
    {
        $property = Property::findorFail($id);
        return view('pages.unit-type.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'size' => 'max:255',
            'lease_price' => 'required|max:255',
        ]);

        $property = Property::findorFail($id);

        $store = UnitType::create([
            'property_id' => $property->id,
            'name' => $request->name,
            'size' => $request->size,
            'lease_price' => $request->lease_price,
        ]);

        if (!$store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('property.show', $property->id);
        } else {
            Alert::success('Created a new unit type '.'"'.$store->name." (".$store->size.")".'"','Success')->autoclose(2500);
            return redirect()->route('property.show', $property->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, UnitType $unitType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UnitType $unitType)
    {
        $property = Property::findorFail($id);

        return view('pages.unit-type.edit', compact('property', 'unitType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UnitType $unitType)
    {
        $request->validate([
            'name' => 'required|max:255',
            'size' => 'max:255',
            'lease_price' => 'required|max:255',
        ]);

        $property = Property::findorFail($id);

        $update = $unitType->update([
            'name' => $request->name,
            'size' => $request->size,
            'lease_price' => $request->lease_price,
        ]);

        if (!$update) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            Alert::success('Updated unit type '.'"'.$unitType->name.'"','Success')->autoclose(2500);
            return redirect()->route('property.show', $property->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property, UnitType $unitType)
    {
        //
    }
}
