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
        $this->property = session()->get('property_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(Request $request)
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

        $property = Property::findorFail($this->property);

        $utility_store = UtilityBill::create([
            'property_id' => $property->id,
            'leasing_agreement_details_id' => $request->agreement,
            'utility_id' =>  $request->meter,
            'to_bill' => $request->to_bill,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'prev_reading' => $request->prev_reading,
            'pres_reading' => $request->pres_reading,
            'amount' => $request->amount,
        ]);

        if (!$utility_store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            $utility = Utility::where('id', $request->meter)->first();
            if ($utility->type == 'Electricity') {
                $utility_update = $utility_store->update([
                    'kw_used' => $request->unit_used,
                ]);
            } elseif ($utility->type == 'Water') {
                $utility_update = $utility_store->update([
                    'cubic_meter' => $request->unit_used,
                ]);
            }
            Alert::success('Created a new utility bill','Success')->autoclose(2500);
            return redirect()->route('utility-bill.index');
        }

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
        $request->validate([
            'field_start_date' => 'nullable',
            'field_end_date' => 'nullable',
            'field_prev_reading' => 'nullable',
            'field_pres_reading' => 'nullable',
            'field_unit_used' => 'nullable',
            'field_amount' => 'required',
        ]);

        $property = Property::findorFail($this->property);

        $utilityBill->update([
            'start_date' => $request->field_start_date,
            'end_date' => $request->field_end_date,
            'prev_reading' => $request->field_prev_reading,
            'pres_reading' => $request->field_pres_reading,
            'amount' => $request->field_amount,
        ]);

        if ($utilityBill->kw_used != null) {
            $utilityBill->update([
                'kw_used' => $request->field_unit_used,
            ]);
        } else {
            $utilityBill->update([
                'cubic_meter' => $request->field_unit_used,
            ]);
        }

        return redirect()->route('utility-bill.index');
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
