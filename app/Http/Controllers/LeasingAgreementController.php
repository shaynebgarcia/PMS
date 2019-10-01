<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeasingAgreement;
use App\LeasingAgreementType;
use App\LeasingPayable;
use App\Payment;
use App\Billing;
use App\Property;
use App\Unit;
use App\UnitType;
use App\Tenant;
use App\User;

use Carbon\Carbon;
use Alert;

class LeasingAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leases = LeasingAgreement::all();
        return view('pages.lease.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::where([
                                            ['date_start_leasing', '<', Carbon::now()],
                                            ])->get();
        $units = Unit::where('status', 'Vacant')->get();
        $tenants = Tenant::all();
        return view('pages.lease.form', compact('properties', 'units', 'tenants'));
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
            'unit' => 'required',
            'tenant' => 'required',
            'monthly_collection' => 'required|min:1|max:28',
            // 'date_of_contract' => 'date',
            // 'move_in' => 'date',
            // 'term_start' => 'date',
            // 'term_end' => 'date',
        ]);

        // Check if default lease price was overriden
        if ($request->agreed_lease_price == null) {
            $unit = Unit::where('id', $request->unit)->first();
            $lease_price_default = UnitType::where('id', $unit->unit_type_id)->first();
            $rental_price = $lease_price_default->lease_price;
        } else {
            $rental_price = $request->agreed_lease_price;
        }

        // Creating agreement
            $agreement_stored = LeasingAgreement::create([
                'tenant_id' => $request->tenant,
                'unit_id' => $request->unit,
                'agreed_lease_price' => $rental_price,
                'date_of_contract' => $request->contract,
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,
                'monthly_collection' => $request->monthly_collection,
                'move_in' => $request->move_in,
            ]);

        if (!$agreement_stored) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('lease.create');
        } else {
            // Updating tenant role
            $tenant = Tenant::where('id', $agreement_stored->tenant_id)->first();
            $user = User::where('id', $tenant->user_id)->first();
            $user_updated = $user->update([
                'role_id' => 5,
            ]);
            // Updating unit status
            $unit = Unit::where('id', $agreement_stored->unit_id)->first();
            $unit_updated = $unit->update([
                'status' => 'Occupied',
            ]);

            Alert::success('Leasing complete', 'Success')->persistent('Close');
            return redirect()->route('lease.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lease = LeasingAgreement::findorFail($id);
        $payables = LeasingPayable::all();
        $payments = Payment::all();
        $billings = Billing::all();
        return view('pages.lease.show', compact('lease', 'payables', 'payments', 'billings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function edit(LeasingAgreement $leasingAgreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeasingAgreement $leasingAgreement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeasingAgreement $leasingAgreement)
    {
        //
    }
}
