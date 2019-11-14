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
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function show(OtherIncome $otherIncome)
    {
        //
    }

    public function group($property_id, $link, $id)
    {
        $property = Property::findorFail($property_id);
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
