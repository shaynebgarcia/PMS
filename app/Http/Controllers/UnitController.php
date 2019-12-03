<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rent;
use App\Property;
use App\Unit;
use App\UnitType;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Utility;

use Alert;

class UnitController extends Controller
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
        $units = Unit::where('property_id', $property->id)->get();
        $unit_types = UnitType::where('property_id', $property->id)->get();

        $leases = LeasingAgreement::all();
        $lease_details = LeasingAgreementDetail::all();
        $utility_electricity = Utility::where('type', 'Electricity')->get();
        $utility_water = Utility::where('type', 'Water')->get();

        return view('pages.unit.index', compact('property', 'units', 'unit_types', 'leases', 'lease_details', 'utility_electricity', 'utility_water'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $property = Property::findorFail($this->property);
        $unit_types = UnitType::where('property_id', $property->id)->get();

        $utilities = Utility::where('unit_id', null)->whereIn('unit_id', $property->unit()->pluck('id'))->get();
        $utilities_electricity = Utility::where('type', 'Electricity')->where('unit_id', null)->whereIn('unit_id', $property->unit()->pluck('id'))->get();
        $utilities_water = Utility::where('type', 'Water')->where('unit_id', null)->whereIn('unit_id', $property->unit()->pluck('id'))->get();

        if (count($unit_types) < 0) {
            return back();
        } else {
            return view('pages.unit.create', compact('property', 'unit_types', 'utilities', 'utilities_electricity', 'utilities_water'));
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
        $request->validate([
            'number' => 'required',
            'type' => 'required',
        ]);

        $property = Property::findorFail($this->property);

        $store = Unit::create([
            'property_id' => $property->id,
            'unit_type_id' => $request->type,
            'floor_no' => $request->floor_no,
            'number' => $request->number,
            'slug' => $property->id.'-'.$request->number,
        ]);

        if (!$store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            if ($request->ue_type != null) {
                $utility_electricity = Utility::findorFail($request->ue_type);
                $update_ue = $utility_electricity->update([
                    'unit_id' => $store->id,
                ]);
            }
            if ($request->uw_type != null) {
                $utility_water = Utility::findorFail($request->uw_type);
                $update_uw = $utility_water->update([
                    'unit_id' => $store->id,
                ]);
            }
            Alert::success('Created a new unit '.'"'.$property->name." (".$store->number.")".'"','Success')->autoclose(2500);
            return redirect()->route('unit.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $property = Property::findorFail($this->property);

        $unit = Unit::where('property_id', $property->$id)->first();
        
        return view('pages.unit.show', compact('property', 'unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $property = Property::findorFail($this->property);
        $unit_types = UnitType::where('property_id', $property->id)->get();

        $utilities = Utility::whereIn('unit_id', $property->unit()->pluck('id'))->get();
        $utilities_electricity = Utility::where('type', 'Electricity')->whereIn('unit_id', $property->unit()->pluck('id'))->get();
        $utilities_water = Utility::where('type', 'Water')->whereIn('unit_id', $property->unit()->pluck('id'))->get();

        if (count($unit_types) < 0) {
            return redirect()->back();
        } else {
            return view('pages.unit.edit', compact('property', 'unit', 'unit_types', 'utilities', 'utilities_electricity', 'utilities_water'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'number' => 'required',
            'type' => 'required',
        ]);

        $property = Property::findorFail($this->property);

        preg_match_all('!\d+!', $request->floor_no, $no_only);
        $var = implode(' ', $no_only[0]);

        $update = $unit->update([
            'unit_type_id' => $request->type,
            'floor_no' => $var,
            'number' => $request->number,
        ]);

        if (!$update) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            if ($request->ue_type != null) {
                $utility_electricity = Utility::findorFail($request->ue_type);
                $update_ue = $utility_electricity->update([
                    'unit_id' => $store->id,
                ]);
            }
            if ($request->uw_type != null) {
                $utility_water = Utility::findorFail($request->uw_type);
                $update_uw = $utility_water->update([
                    'unit_id' => $store->id,
                ]);
            }
            Alert::success('Updated a unit '.'"'.$property->name." (".$unit->number.")".'"','Success')->autoclose(2500);
            return redirect()->route('property.show', $property->id);
        }

        return redirect()->route('property.show', $property->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $property = Property::findorFail($this->property);
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
