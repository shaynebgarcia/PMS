<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
use App\TenantList;
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
        $leases = LeasingAgreement::where('property_id', $property->id)->get();

        $details = LeasingAgreementDetail::all();
        $property_access = PropertyAccess::all();
        $payments = Payment::all();
        $services = Service::all();
        $service_types = ServiceType::all();
        $utilities = Utility::all();
        $billings = Billing::all();

        $now = Carbon::now();

        return view('pages.lease.index', compact('property', 'leases', 'details', 'property_access', 'payments', 'services', 'service_types', 'utilities', 'billings', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::findorFail($this->property);
        $properties = Property::where([
                                        ['id', '=', $property->id],
                                        ['date_start_leasing', '<', Carbon::now()],
                                    ])->get();
        $units = Unit::where('leasing_agreement_id', null)->get();
        $tenants = Tenant::where('property_id', $property->id)->get();
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
    public function store(Request $request)
    {
        $request->validate([
            'unit' => 'required',
            'tenants' => 'required',
            // 'term_start' => 'required|date|after:term_end',
            // 'term_end' => 'required|date|before:term_start',
            // 'first_day' => Rule::requiredIf($request->full_payment, !null),
            // 'date_of_contract' => 'date',
            // 'move_in' => 'date',
        ]);

        $property = Property::findorFail($this->property);

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
            'property_id' => $property->id,
            'unit_id' => $request->unit,
            'status_id' => 3,
        ]);
        if ($agreement_stored) {

            $agreement_stored->update([
                'link_id' => config('pms.unique_prefix.leasing_agreement').$agreement_stored->id,
            ]);

            //Check total tenant list
            if(count($request->tenants) > 0) {
                foreach($request->tenants as $item => $v) {
                    // Create each tenant list
                    $array = array (
                        'leasing_agreement_id' => $agreement_stored->id,
                        'tenant_id' => $request->tenants[$item],
                    );
                    $list_to = TenantList::insert($array);
                }
            }

            // Creating agreement details
            $agreement_details_stored = LeasingAgreementDetail::create([
                'property_id' => $property->id,
                'leasing_agreement_id' => $agreement_stored->id,
                'agreement_no' => null,
                'description' => 'Original',

                'agreed_lease_price' => $rental_price,
                'agreed_lease_price_daily' => null,

                'term_duration' => $request->term_duration,
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,

                'first_day' => $request->first_day,
                'last_day' => null,
                'monthly_due' => date("d", strtotime($request->first_day)),
                'last_billing_my' => null,

                'status_id' => 6,
                'expired' => null,
                'renewed' => null,
            ]);

            if ($agreement_details_stored) {
                //Update unique id
                $agreement_details_stored->update([
                    'agreement_no' => config('pms.unique_prefix.leasing_agreement_details').$agreement_details_stored->id,
                    'last_billing_my' => date('MY', strtotime($request->term_end)),
                ]);
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

                            if ($request->first_day == $request->start[$item]) {
                                $start    = (new DateTime($request->start[$item]))->modify('next month');
                            } else {
                                $start    = (new DateTime($request->start[$item]));
                            }
                            $end      = (new DateTime($request->end[$item]));
                            $interval = DateInterval::createFromDateString('1 month');
                            $period   = new DatePeriod($start, $interval, $end);
                            $period_count = 0;

                            foreach ($period as $dt) {

                                $service_bill_from = $agreement_details_stored->bill_from($dt->format("MY"));
                                $service_bill_to = $agreement_details_stored->bill_to($service_bill_from);

                                // Create each service bill
                                $array = array (
                                    'leasing_agreement_details_id' => $agreement_details_stored->id,
                                    'service_type_id' => $request->subscriptions[$item],
                                    'to_bill' => $dt->format("MY"),
                                    'start_date' => Ymd($service_bill_from),
                                    'end_date' => Ymd($service_bill_to),
                                    'amount' => $service_price,
                                );
                                $new_sub_id = Service::create($array)->id;
                                $period_count++;
                            }
                            
                            //GET first service bill
                            $service_bill_first = Service::where('leasing_agreement_details_id', $agreement_details_stored->id)->first();
                            $service_bill_last = Service::where('leasing_agreement_details_id', $agreement_details_stored->id)->orderBy('id', 'desc')->first();

                            //UPDATE service bill
                            $service_bill_first->update([
                                'first_bill' => 1,
                                'start_date' => $request->start[$item],
                                'amount' => ($service_bill_first->amount / config('pms.billing.services.days_to_get_daily_rate')) * no_days($request->start[$item], $service_bill_first->end_date),
                            ]);
                            if ($request->first_day != $request->start[$item]) {
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

                

                // Check and update if there is payments applied
                if ($request->reservation != null) {
                    $payment = Payment::where('id', $request->reservation)->first();
                    $payment->update(['leasing_agreement_details_id' => $agreement_stored->id]);
                }
                if ($request->full_payment != null) {
                    $payment = Payment::where('id', $request->full_payment)->first();
                    $payment->update(['leasing_agreement_details_id' => $agreement_stored->id]);
                }
                if ($request->utility_deposit != null) {
                    $payment = Payment::where('id', $request->utility_deposit)->first();
                    $payment->update(['leasing_agreement_details_id' => $agreement_stored->id]);
                }
            }
                
            // Updating unit status
            $unit = Unit::where('id', $agreement_stored->unit_id)->first();
            $unit_updated = $unit->update([
                'leasing_agreement_id' => $agreement_stored->id,
            ]);

            $unit_stored = Unit::where('id', $agreement_stored->unit_id)->first();
            Alert::success('Leasing complete', 'Success')->persistent('Close');
            return redirect()->route('lease.index');
        } else {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('lease.create');
        }
    }

    public function renewform($link)
    {
        $property = Property::findorFail($this->property);

        $lease = LeasingAgreement::findorFail($link);
        $payments = Payment::where('leasing_agreement_details_id', null)->where('billing_id', null)->get();
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
    public function show($link)
    {
        $property = Property::findorFail($this->property);

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

    public function getTerm(Request $request)
    {
        $lease = LeasingAgreement::findorFail($request->id);
        $lease_detail = LeasingAgreementDetail::where('leasing_agreement_id', $lease->id)->where('status', 'Active')->first();

        $start    = (new DateTime($lease_detail->term_start))->modify('first day of this month');
        $end      = (new DateTime($lease_detail->term_end))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $data = '<option value="#" disabled selected>Select Month</option>';
        foreach ($period as $dt) {
            $data .= '<option value="'.$dt->format("MY").'">'.$dt->format("F Y").'</option>';
        }
        return response()->json($data);
    }

    public function exportPDF_contract($link, $lease_id)
    {
        $property = Property::findorFail($this->property);
        $lease = LeasingAgreementDetail::findorFail($lease_id);
        $date_generated = date('F d, Y H:i A');
        $PDF = PDF::loadView('reports.pdf_contract', ['lease'=>$lease, 'date_generated'=>$date_generated])->setPaper('portrait');
        /*->setOptions(['defaultFont'=>'Helvetica']);*/
        // return $PDF->stream();

        return $PDF->stream();
    }
}
