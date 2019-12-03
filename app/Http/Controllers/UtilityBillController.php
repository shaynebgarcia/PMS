<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Property;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Utility;
use App\UtilityBill;
use App\PropertyAccess;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class UtilityBillController extends Controller
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
    public function index($code)
    {

        $property = Property::findorFail($this->property);
        $leases = LeasingAgreement::where('property_id', $property->id)->get();
        // $lease_detail = LeasingAgreementDetail::findorFail($id);
        $property_access = PropertyAccess::all();

        $now = Carbon::now();

        $start    = (new DateTime(date('d-M-Y', strtotime('-1 year', strtotime($now)))))->modify('first day of this month');
        $end      = (new DateTime(date('d-M-Y', strtotime('+1 year', strtotime($now)))))->modify('first day of this month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $utility_bills = UtilityBill::where('property_id', $property->id)->get();
        return view('pages.utility.utility-bills.index', compact('property', 'property_access', 'leases', 'utility_bills', 'period'));
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
    public function store(Request $request, $code)
    {
        $request->validate([
            'agreement' => 'required',
            'meter' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'prev_reading' => 'nullable',
            'pres_reading' => 'nullable',
            'unit_used' => 'nullable',
            'amount' => 'required',
            'to_bill' => 'required',
        ]);

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

    public function group($link, $id)
    {
        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);

        $utility_bills = UtilityBill::where('leasing_agreement_details_id', $id)->get();
        $property_access = PropertyAccess::all();
        return view('pages.utility.utility-bills.group', compact('property', 'lease', 'lease_detail', 'utility_bills', 'property_access'));
    }
}
