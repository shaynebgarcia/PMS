<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Property;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\OtherIncome;
use App\OtherIncomeType;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class OtherIncomeController extends Controller
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
    public function store(Request $request, $link, $id)
    {
        $property = Property::findorFail($this->property);

        $request->validate([
            'oincome_type' => 'required',
            'amount' => 'nullable',
            'note' => 'nullable',
            'to_bill' => 'required',
        ]);

        // Check if default lease price was overriden
        if ($request->amount == null) {
            $oincome_price_default = OtherIncomeType::where('id', $request->oincome_type)->first();
            $oincome_amount = $oincome_price_default->amount;
        } else {
            $oincome_amount = floatval($request->amount);
        }

        // Creating other income
        $oincome_stored = OtherIncome::create([
            'leasing_agreement_details_id' => $id,
            'other_income_type_id' => $request->oincome_type,
            'to_bill' => $request->to_bill,
            'total_amount' => $oincome_amount,
            'note' => $request->note,
        ]);

        if (!$oincome_stored) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            Alert::success('Other income creation complete', 'Success')->persistent('Close');
            return redirect()->route('oincome.group.lease', [$link, $id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function show(OtherIncome $otherIncome)
    {
        //
    }

    public function group($link, $id)
    {
        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);
        $otherincome_types = OtherIncomeType::all();
        $otherincome = OtherIncome::all();

        $now = Carbon::now();

        $start    = (new DateTime($now))->modify('first day of this month');
        $end      = (new DateTime(date('d-M-Y', strtotime('+1 year', strtotime($now)))))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        return view('pages.otherincome.group', compact('property', 'lease', 'lease_detail', 'otherincome_types', 'otherincome', 'period'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherIncome $otherIncome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherIncome $otherIncome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherIncome $otherIncome)
    {
        //
    }
}
