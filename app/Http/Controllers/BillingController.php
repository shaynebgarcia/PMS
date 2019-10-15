<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Billing;
use App\UtilityBill;
use App\Service;

use Carbon\Carbon;
use Alert;

class BillingController extends Controller
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
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function display($id, Billing $billing, $billing_my)
    {
        $latest_lease_details = LeasingAgreementDetail::findorFail($id);
        $lease = LeasingAgreement::where('id', $latest_lease_details->leasing_agreement_id)->first();
        $latest_sub_services = Service::where('leasing_agreement_details_id', $latest_lease_details->id)->get();
        $bill_match = ['leasing_agreement_detail_id' => $latest_lease_details->id, 'to_bill' => $billing_my];
        $utility_bill = UtilityBill::where($bill_match)->get();
        $now = Carbon::now();
        $bill_month_now = $now->format('MY');

        return view('pages.billing.display', compact('billing', 'billing_my', 'lease', 'latest_lease_details', 'latest_sub_services', 'utility_bill', 'bill_month_now'));
    }
    public function publish($id, Billing $billing, $billing_my)
    {
        $request->validate([
            'invoice_no' => 'required',
            'prepared_by' => 'required',
        ]);

        
    }
    public function show(Billing $billing)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        //
    }
}
