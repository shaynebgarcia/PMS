<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rent;
use App\Property;
use App\Unit;
use App\UnitType;
use App\LeasingAgreement;
use Alert;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('pages.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $property = Property::findorFail($id);
        // $property = Property::where('slug', $property_slug)->first();
        $unit_types = UnitType::where('property_id', $property->id)->get();

        if (count($unit_types) < 0) {
            return back();
        } else {
            return view('pages.unit.create', compact('property', 'unit_types'));
        }
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
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::findorFail($id);
        // $property = Property::where('slug', $property_slug)->first();
        $unit = Unit::where('property_id', $id)->first();
        
        return view('pages.unit.show', compact('property', 'unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $slug)
    {
        //
    }

    // GET | Assigning tenant to a unit
    public function rentform(Property $property, Unit $unit)
    {
        $tenants = User::where('role_id', 5)->get();
        return view('pages.unit.rent-form', compact('property', 'unit', 'tenants'));
    }

    // POST | Assigning tenant to a unit
    public function rentassign(Request $request, Property $property, Unit $unit)
    {
        $request->validate([
            'tenant' => 'required',
            'term_start' => 'date',
            'term_end' => 'date',
        ]);

        // Check if default lease price was overriden
        if ($request->agreed_lease_price == null) {
            $lease_price_default = UnitType::where('property_id', $property->id)->where('id', $unit->unit_type_id)->first();
            $rental_price = $lease_price_default->lease_price;
        } else {
            $rental_price = $request->agreed_lease_price;
        }
            // Creating agreement
            $agreement_stored = LeasingAgreement::create([
                'tenant_id' => $request->tenant,
                'unit_id' => $unit->id,
                'agreed_lease_price' => $rental_price,
                'contract' => $request->contract,
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,
                'monthly_collection' => $request->monthly_collection,
                'move_in' => $request->move_in,
            ]);

        if (!$agreement_stored) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('unit.show', [$property->id, $unit->id]);
        } else {
            // Updating unit status
            $unit_updated = $unit->update([
                'status' => 'Occupied'
            ]);
            // Creating leasing payables
            LeasingPayable::insert([
                'agreement_id' => $agreement_stored->id,
                'payment_type_id' => 1,
                'amount' => $request->reservation_amount,
            ]);
            LeasingPayable::insert([
                'agreement_id' => $agreement_stored->id,
                'payment_type_id' => 4,
                'amount' => $request->reservation_amount,
            ]);
            LeasingPayable::insert([
                'agreement_id' => $agreement_stored->id,
                'payment_type_id' => 5,
                'amount' => $request->reservation_amount,
            ]);

            $new_tenant = User::where('id', $agreement_stored->tenant_id)->first();
            $unit_type = UnitType::where('id', $unit->unit_type_id)->first();
            Alert::success('Unit '.$property->name.", ".$unit_type->name." (".$unit_type->size.") "."- ".$unit->number." new leasee is ".$new_tenant->lastname.", ".$new_tenant->firstname." ".$new_tenant->middlename,'Success')->autoclose(2500);
            return redirect()->route('unit.show', [$property->id, $unit->id]);
        }
    }
}
