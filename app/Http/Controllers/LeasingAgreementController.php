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
use App\Utility;
use App\Property;
use App\Unit;
use App\UnitType;
use App\Tenant;
use App\User;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class LeasingAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        $property = Property::findorFail($property_id);
        $leases = LeasingAgreement::where('property_id', $property->id)->get();

        $details = LeasingAgreementDetail::all();
        $property_access = PropertyAccess::all();
        $payments = Payment::all();
        $services = Service::all();
        $utilities = Utility::all();
        $billings = Billing::all();

        $now = Carbon::now();

        return view('pages.lease.index', compact('property', 'leases', 'details', 'property_access', 'payments', 'services', 'utilities', 'billings', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($property_id)
    {
        $property = Property::findorFail($property_id);
        $properties = Property::where([
                                        ['id', '=', $property_id],
                                        ['date_start_leasing', '<', Carbon::now()],
                                    ])->get();
        $units = Unit::where('leasing_agreement_id', null)->get();
        $tenants = Tenant::all();
        $payments = Payment::where('leasing_agreement_details_id', null)->where('billing_id', null)->get();
        $services = ServiceType::all();
        return view('pages.lease.form', compact('property', 'properties', 'units', 'tenants', 'payments', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $property_id)
    {
        $request->validate([
            'unit' => 'required',
            'tenant' => 'required',
            'agreement_no' => 'required|unique:leasing_agreement_details',
            'monthly_due' => 'required|min:1|max:31',
            'first_day' => 'required',
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
            'property_id' => $property_id,
            'tenant_id' => $request->tenant,
            'unit_id' => $request->unit,
            'agreement_status_id' => 1,
        ]);

        if ($agreement_stored) {

            $agreement_stored->update([
                'link_id' => $agreement_stored->unit_id.$agreement_stored->tenant_id.'-'.$agreement_stored->id,
            ]);

            // Creating agreement details
            $agreement_details_stored = LeasingAgreementDetail::create([
                'leasing_agreement_id' => $agreement_stored->id,
                'agreement_no' => $request->agreement_no,
                'agreed_lease_price' => $rental_price,
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,
                'first_day' => $request->first_day,
                'monthly_due' => $request->monthly_due,
            ]);

            if ($agreement_details_stored) {
                // Check and creating services applied
                if ($request->subscriptions != null) {
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
                }
                // Check and update if there is payments applied
                if ($request->reservation != null) {
                    $payment = Payment::where('id', $request->reservation)->first();
                    $payment_updated = $payment->update(['leasing_agreement_details_id' => $agreement_stored->id]);
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

            $unit_stored = Unit::where('id', $agreement_stored->unit_id)->first();
            Alert::success('Leasing complete', 'Success')->persistent('Close');
            return redirect()->route('lease.show', [$unit_stored->property_id,$agreement_stored->id]);
        } else {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('lease.create');
        }

    }

    public function renewform($property_id, $link, $id)
    {
        $property = Property::findorFail($property_id);
        $lease = LeasingAgreement::findorFail($link);
        $payments = Payment::where('leasing_agreement_id', null)->where('billing_id', null)->get();
        $services = ServiceType::all();
        return view('pages.lease.renew', compact('property', 'lease', 'payments', 'services'));
    }

    public function renew(Request $request) {

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\LeasingAgreement  $leasingAgreement
     * @return \Illuminate\Http\Response
     */
    public function show($property_id, $link)
    {
        $property = Property::findorFail($property_id);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::where('leasing_agreement_id', $lease->id)->get();
        $payments = Payment::all();
        $services = Service::all();
        $utilities = Utility::all();
        $billings = Billing::all();

        return view('pages.lease.show', compact('property', 'lease', 'lease_detail', 'payments', 'services', 'utilities', 'billings'));
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
    public function exportPDF_contract($property_id, $link, $lease_id)
    {
        $lease = LeasingAgreementDetail::findorFail($lease_id);
        $date_generated = date('F d, Y H:i A');
        $PDF = PDF::loadView('reports.pdf_contract', ['lease'=>$lease, 'date_generated'=>$date_generated])->setPaper('portrait');
        /*->setOptions(['defaultFont'=>'Helvetica']);*/
        return $PDF->stream();
    }
}
