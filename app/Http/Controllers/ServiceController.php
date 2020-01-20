<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Property;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\ServiceType;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class ServiceController extends Controller
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
        $services = Service::where('property_id', $property->id)->get();

        return view('pages.service.service-subscriptions.index', compact('property', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::findorFail($this->property);
        $leases = LeasingAgreement::where('property_id', $property->id)->get();
        $services = ServiceType::all();

        return view('pages.service.service-subscriptions.create', compact('property', 'leases', 'services'));
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
        ]);

        $property = Property::findorFail($this->property);
        $lease_detail = LeasingAgreementDetail::where('id', $request->agreement)->first();

        // Check and creating services applied
        if ($request->subscriptions != null) {
            if(count($request->subscriptions)>0) {
                foreach($request->subscriptions as $item =>$v) {

                    // Check last service no
                    $last_service = Service::where('leasing_agreement_details_id', $lease_detail->id)->latest()->first();
                    if($last_service == null) {
                        $current_service_no = config('pms.unique_prefix.service').'1';
                    } else {
                        $current_service_no = config('pms.unique_prefix.service').strval(intval(substr($last_service->service_no, -1))+1);
                    }

                    // Check if service price was overriden
                    if ($request->amounts[$item] == null) {
                        $service = ServiceType::where('id', $request->subscriptions[$item])->first();
                        $service_price = $service->amount;
                    } else {
                        $service_price = floatval($request->amounts[$item]);
                    }

                    if ($lease_detail->first_day == $request->start[$item]) {
                        $start    = (new DateTime($request->start[$item]))->modify('next month');
                    } else {
                        $start    = (new DateTime($request->start[$item]));
                    }
                    $end      = (new DateTime($request->end[$item]));
                    $interval = DateInterval::createFromDateString('1 month');
                    $period   = new DatePeriod($start, $interval, $end);
                    $period_count = 0;

                    foreach ($period as $dt) {

                        $service_bill_from = $lease_detail->bill_from($dt->format("MY"));
                        $service_bill_to = $lease_detail->bill_to($service_bill_from);

                        // Create each service bill
                        $array = array (
                            'property_id' => $property->id,
                            'service_no' => $current_service_no,
                            'leasing_agreement_details_id' => $lease_detail->id,
                            'service_type_id' => $request->subscriptions[$item],
                            'to_bill' => $dt->format("MY"),
                            'start_date' => Ymd($service_bill_from),
                            'end_date' => Ymd($service_bill_to),
                            'amount' => $service_price,
                        );
                        $new_sub = Service::create($array);
                        $period_count++;
                    }
                    
                    //GET first service bill
                    $service_bill_first = Service::where('leasing_agreement_details_id', $lease_detail->id)->where('service_no', $current_service_no)->first();
                    $service_bill_last = Service::where('leasing_agreement_details_id', $lease_detail->id)->orderBy('id', 'desc')->first();

                    //UPDATE service bill
                    $service_bill_first->update([
                        'first_bill' => 1,
                        'start_date' => $request->start[$item],
                        'amount' => ($service_bill_first->amount / config('pms.billing.services.days_to_get_daily_rate')) * no_days($request->start[$item], $service_bill_first->end_date),
                    ]);
                    if ($lease_detail->first_day != $request->start[$item]) {
                        $service_bill_last->update([
                            'end_date' => $request->end[$item],
                            'amount' => ($service_bill_last->amount / config('pms.billing.services.days_to_get_daily_rate')) * no_days($service_bill_last->start_date, $request->end[$item]),
                        ]);
                    }
                    //UPDATE end_date if subscription is less than 1/month
                    if (($period_count) == 1) {
                        $service_bill_first->update([
                            'end_date' => $request->end[$item],
                            'amount' => ($service_bill_first->amount / config('pms.billing.services.days_to_get_daily_rate') ) * no_days($request->start[$item], $request->end[$item]),
                        ]);
                    }
                     //Check if start of subscription is not the same with billing date
                    // if ($request->first_day != $request->start[$item]) {
                    // }
                    //Check if end of subscription is the same with last start_date of the billing service
                    // if ($service_bill_last->start_date == $request->end[$item]) {
                    //     $service_bill_last->update([
                    //         'end_date' => $request->end[$item],
                    //         'amount' => ($service_bill_last->amount / 30) * no_days($service_bill_last->start_date, $request->end[$item]),
                    //     ]);
                    // }

                    //DELETE service without amount
                    $zero_amount = Service::where('amount', 0)->get();
                    foreach ($zero_amount as $zero) {
                        $zero->delete();
                    }
                }
            
            }
        }

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    public function group($link, $id)
    {
        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);
        $services = Service::where('leasing_agreement_details_id', $id)->get();

        return view('pages.service.service-subscriptions.group', compact('property', 'lease', 'lease_detail', 'services'));
    }
}
