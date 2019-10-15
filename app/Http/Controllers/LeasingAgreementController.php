<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\LeasingAgreementStatus;
use App\PropertyAccess;
use App\Payment;
use App\Billing;
use App\Service;
use App\ServiceType;
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
        $details = LeasingAgreementDetail::all();
        $property_access = PropertyAccess::all();
        return view('pages.lease.index', compact('leases', 'details', 'property_access'));
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
        $units = Unit::where('leasing_agreement_id', null)->get();
        $tenants = Tenant::all();
        $payments = Payment::all();
        $services = ServiceType::all();
        return view('pages.lease.form', compact('properties', 'units', 'tenants', 'payments', 'services'));
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
            'monthly_due' => 'required|min:1|max:31',
            'first_day' => 'required'
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
            $rental_price = floatval($request->agreed_lease_price);
        }

        // Creating agreement
        $agreement_stored = LeasingAgreement::create([
            'tenant_id' => $request->tenant,
            'unit_id' => $request->unit,
            'agreement_status_id' => 1,
        ]);

        if ($agreement_stored) {

            // Creating agreement details
            $agreement_details_stored = LeasingAgreementDetail::create([
                'leasing_agreement_id' => $agreement_stored->id,
                'agreed_lease_price' => $rental_price,
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,
                'first_day' => $request->first_day,
                'monthly_due' => $request->monthly_due,
            ]);

            if ($agreement_details_stored) {
                // Check and creating services applied
                if(count($request->subscriptions)>0) {
                    foreach($request->subscriptions as $item =>$v) {
                        // Check if service price was overriden
                        if ($request->amounts[$item] == null) {
                            $service = ServiceType::where('id', $request->subscriptions[$item])->first();
                            $service_price = $service->amount;
                        } else {
                            $service_price = floatval($request->amounts[$item]);
                        }
                        // Create each service subscription
                        $array = array (
                            'leasing_agreement_details_id' => $agreement_details_stored->id,
                            'service_type_id' => $request->subscriptions[$item],
                            'agreed_amount' => $service_price,
                        );
                        $new_sub_id = Service::create($array)->id;
                    }
                }

                // Check and update if there is payments applied
                if ($request->reservation != null) {
                    $payment = Payment::where('id', $request->reservation)->first();
                    $payment_updated = $payment->update(['leasing_agreement_id' => $agreement_stored->id]);
                }
            }
                
            // Updating tenant role
            $tenant = Tenant::where('id', $agreement_stored->tenant_id)->first();
            $user = User::where('id', $tenant->user_id)->first();
            $user_updated = $user->update([
                'role_id' => 8,
            ]);

            // Updating unit status
            $unit = Unit::where('id', $agreement_stored->unit_id)->first();
            $unit_updated = $unit->update([
                'leasing_agreement_id' => $agreement_stored->id,
            ]);

            Alert::success('Leasing complete', 'Success')->persistent('Close');
            return redirect()->route('lease.show', $agreement_stored->id);
        } else {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('lease.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function show($property, $id)
    {
        $property = Property::findorFail($property);
        $lease = LeasingAgreement::findorFail($id);
        $lease_detail = LeasingAgreementDetail::where('leasing_agreement_id', $lease->id)->latest()->first();
        $payables = LeasingPayable::all();
        $payments = Payment::all();
        $billings = Billing::all();
        $now = Carbon::now();
        $bill_month_now = $now->format('MY');
        return view('pages.lease.show', compact('property', 'lease', 'lease_detail', 'payables', 'payments', 'billings', 'bill_month_now'));
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
