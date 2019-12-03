<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Unit;
use App\Utility;
use App\LeasingAgreementDetail;

use Alert;

class UtilityController extends Controller
{
    public function __construct(Request $request)
    {
        $this->property = $request->session()->get('property_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Property::findorFail($this->property);
        $utilities = Utility::whereIn('unit_id', $property->unit()->pluck('id'))->get();
        
        return view('pages.utility.index', compact('property', 'utilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::findorFail($this->property);
        $units = Unit::where('property_id', $property->id)->get();
        $utility_types = Utility::select('type')->distinct()->get();

        return view('pages.utility.create', compact('property', 'units', 'utility_types'));
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
            'type' => 'required',
            'no' => 'required',
            'unit' => 'nullable',
        ]);

        $property = Property::findorFail($this->property);

        $store = Utility::create([
            'type' => $request->type,
            'no' => $request->no,
        ]);

        if (!$store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            if ($request->unit != null) {
                $update_utility = $store->update([
                    'unit_id' => $request->unit,
                ]);
            }
            Alert::success('Created a new utility '.'"'.$property->name." (".$store->no.")".'"','Success')->autoclose(2500);
            return redirect()->route('utilities.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function show(Utility $utility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function edit(Utility $utility)
    {
        $property = Property::findorFail($this->property);
        $units = Unit::where('property_id', $property->id)->get();
        $utility_types = Utility::select('type')->distinct()->get();

        return view('pages.utility.edit', compact('property', 'utility', 'units', 'utility_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utility $utility)
    {
        $request->validate([
            'type' => 'required',
            'no' => 'required',
            'unit' => 'nullable',
        ]);

        $property = Property::findorFail($this->property);

        $update = $utility->update([
            'type' => $request->type,
            'no' => $request->no,
            'unit_id' => $request->unit,
        ]);

        if (!$update) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            Alert::success('Updated utility details '.'"'.$property->name." (".$update->no.")".'"','Success')->autoclose(2500);
            return redirect()->route('utilities.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utility $utility)
    {
        //
    }

    public function getUtilities(Request $request)
    {
        $lease_detail = LeasingAgreementDetail::where('id', $request->id)->first();

        $match = ['unit_id' => $lease_detail->agreement->unit->id];

        $utilities = Utility::where($match)->get();

        $data = '<option value="#" disabled selected>Select a Meter</option>';
        foreach ($utilities as $utility) {
            $data .= '<option value="'.$utility->id.'">'.$utility->type.' | #'.$utility->no.'</option>';
        }
        return response()->json($data);
    }
}
