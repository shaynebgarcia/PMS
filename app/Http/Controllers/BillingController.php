<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Billing;
use App\BillingDetail;
use App\UtilityBill;
use App\Utility;
use App\Payment;
use App\Service;
use App\ServiceType;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class BillingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        $property = Property::findorFail($property_id);
        $payments = Payment::all();

        $all_bill = Billing::all();
        $billings = DB::table('billings')
            ->join('leasing_agreement_details', 'billings.leasing_agreement_details_id', '=', 'leasing_agreement_details.id')
            ->join('leasing_agreements', 'leasing_agreement_details.leasing_agreement_id', '=', 'leasing_agreements.id')
            ->join('units', 'leasing_agreements.unit_id', '=', 'units.id')
            ->join('properties', 'units.property_id', '=', 'properties.id')
            ->select('billings.*')
            ->where('properties.id', $property_id)
            ->get();

        return view('pages.billing.index', compact('property', 'billings', 'all_bill', 'payments'));
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
    public function group($property_id, $link, $id)
    {
        $property = Property::findorFail($property_id);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);
        $billings = Billing::where('leasing_agreement_details_id', $id)->get();
        $now = Carbon::now();
        $last_bill = Billing::where('leasing_agreement_details_id', $lease_detail->id)->latest()->first();
        $bill_month_now = $now->format('MY');
        // $bill_month_next = date('MY', strtotime('+1 month', strtotime($now)));
        $bill_month_next = date('MY', strtotime('+1 month', strtotime($lease_detail->first_day)));

        if (($last_bill != null) == true) {
            $next_bill_due = date('MY', strtotime('-7 day', strtotime($last_bill->billing_to)));
            $last_bill_my_next = date('MY', strtotime('+1 month', strtotime($last_bill->monthyear)));
            if ($last_bill->billing_to != $now) {
                $bill_this = $last_bill_my_next;
            } else {
                $bill_this = $next_bill_due;
            }
        } else {
            $bill_this = $bill_month_next;
        }

        $payments = Payment::all();

        $start    = (new DateTime($lease_detail->term_start))->modify('first day of next month');
        $end      = (new DateTime($now))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $generate_date_from = strtotime($lease_detail->term_start); 
        $generate_date_to = strtotime($now);
        

        return view('pages.billing.group', compact('property', 'lease', 'lease_detail', 'billings', 'payments', 'now', 'bill_this', 'period', 'generate_date_to'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function display($property_id, $link, $lease_id, Billing $billing, $billing_my)
    {
        $property = Property::findorFail($property_id);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($lease_id);

        $latest_sub_services = Service::where('leasing_agreement_details_id', $lease_detail->id)->get();
        $utility_bill = UtilityBill::where(['leasing_agreement_details_id' => $lease_detail->id, 'to_bill' => $billing_my])->get();
        
        $last_bill = Billing::where(['leasing_agreement_details_id' => $lease_detail->id, 'monthyear'=> date('MY', strtotime('-1 month', strtotime($billing_my)))])->first();
        if ($last_bill != null) {
            $prev_billing_payment = Payment::where('billing_id', $last_bill->id)->first();
            if ($prev_billing_payment != null) {
                $ou = ($prev_billing_payment->amount_due - $prev_billing_payment->amount_paid);
            } else {
                $ou = 0;
            }
        } else {
            $ou = 0;
            $prev_billing_payment = 0;
        }

        

        $now = Carbon::now();
        $bill_month_now = $now->format('MY');
        // $bill_month_next = date('MY', strtotime('+1 month', strtotime($now)));
        $bill_month_next = date('MY', strtotime('+1 month', strtotime($lease_detail->first_day)));

        $bill_from = $lease_detail->bill_from($billing_my);
        $bill_to = $lease_detail->bill_to($bill_from);
        $bill_due = $lease_detail->bill_due($bill_from);
        $bill_date = $lease_detail->bill_date($now);
        $rental_price = $lease_detail->rental_price();
        $subtotal_subservices = $lease_detail->subtotal_subservices($latest_sub_services);
        $subtotal_utilitybill = $lease_detail->subtotal_utilitybill($utility_bill);
        $subtotal_array = [$rental_price, $subtotal_subservices, $subtotal_utilitybill];
        $subtotal = $lease_detail->subtotal($subtotal_array);
        $OUpayment = $lease_detail->oupayment($ou);
        $total = $lease_detail->total($subtotal, $ou);

        return view('pages.billing.display', compact(   'property',
                                                        'billing',
                                                        'last_bill',
                                                        'billing_my',
                                                        'lease',
                                                        'lease_detail',
                                                        'latest_sub_services',
                                                        'utility_bill',
                                                        'bill_month_now',
                                                        'bill_month_next',
                                                        'now',
                                                        'prev_billing_payment',
                                                        'bill_from', 'bill_to', 'bill_due', 'bill_date',
                                                        'rental_price', 'subtotal_subservices', 'subtotal_utilitybill', 'subtotal', 'OUpayment', 'total'
                                                        ));
    }
    public function publish(Request $request, $property_id, $link, $lease_id, Billing $billing, $billing_my)
    {
        $request->validate([
            'invoice_no' => 'required',
            'prepared_by' => 'required',
        ]);

        $property = Property::findorFail($property_id);
        $lease = LeasingAgreement::findorFail($link);
        $lease_details = LeasingAgreementDetail::findorFail($lease_id);

        $latest_sub_services = Service::where('leasing_agreement_details_id', $lease_details->id)->get();
        $utility_bill = UtilityBill::where(['leasing_agreement_details_id' => $lease_details->id, 'to_bill' => $billing_my])->get();

        $last_bill = Billing::where(['leasing_agreement_details_id' => $lease_details->id, 'monthyear'=> date('MY', strtotime('-1 month', strtotime($billing_my)))])->first();

        if ($last_bill != null) {
            $prev_billing_payment = Payment::where('billing_id', $last_bill->id)->first();
            if ($prev_billing_payment != null) {
                $ou = ($prev_billing_payment->amount_due - $prev_billing_payment->amount_paid);
            } else {
                $ou = 0;
            }
        } else {
            $ou = 0;
        }
        

        $now = Carbon::now();
        $bill_month_now = $now->format('MY');

        $bill_from = $lease_details->bill_from($billing_my);
        $bill_to = $lease_details->bill_to($bill_from);
        $bill_due = $lease_details->bill_due($bill_from);
        $bill_date = $lease_details->bill_date($now);
        $rental_price = $lease_details->rental_price();
        $subtotal_subservices = $lease_details->subtotal_subservices($latest_sub_services);
        $subtotal_utilitybill = $lease_details->subtotal_utilitybill($utility_bill);
        $subtotal_array = [$rental_price, $subtotal_subservices, $subtotal_utilitybill];
        $subtotal = $lease_details->subtotal($subtotal_array);
        $OUpayment = $lease_details->oupayment($ou);
        $total = $lease_details->total($subtotal, $ou);

        $check = $bill_due <= $bill_date;
        if($check == false) {
            Alert::error('Bill has not met its billing date', 'Cannot Publish')->persistent('Close');
            return redirect()->route('lease.index');
        } else {
            // Publishing bill
                $bill_published = Billing::create([
                    'leasing_agreement_details_id' => $lease_id,
                    'invoice_no' => $request->invoice_no,
                    'prepared_by' => $request->prepared_by,
                    'monthyear' => $billing_my,
                    'billing_to' => date('Y-m-d', strtotime($bill_to)),
                    'billing_from' => date('Y-m-d', strtotime($bill_from)),
                    'billing_date' => $now,
                    'due_date' => date('Y-m-d', strtotime($bill_due)),
                    'subtotal_amount' => $subtotal,
                    'ou_amount' => $OUpayment,
                    'total_amount_due' => $total,
                    'created_at' => $now,
                ]);

                if ($bill_published) {
                    BillingDetail::insert([
                        'billing_id' => $bill_published->id,
                        'description' => 'Rental',
                        'amount' => $rental_price,
                        'created_at' => $now,
                    ]);
                    foreach ($latest_sub_services as $bill) {
                        // $type = ServiceType::where('id', $bill->service_type_id)->first();
                        BillingDetail::insert([
                            'billing_id' => $bill_published->id,
                            'description' => $bill->service_type->name,
                            'amount' => $bill->agreed_amount,
                            'created_at' => $now,
                        ]);
                    }
                    foreach ($utility_bill as $bill) {
                        // $type = UtilityType::where('id', $bill->utility_id)->first();
                        BillingDetail::insert([
                            'billing_id' => $bill_published->id,
                            'description' => $bill->utility->type,
                            'amount' => $bill->amount,
                            'created_at' => $now,
                        ]);
                    }
                }
            Alert::success('Bill has been published', 'Publish')->persistent('Close');
        }
        return redirect()->route('lease.index');
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

    public function exportPDF_invoice($property_id, $link, $lease_id, $billing_id)
    {
        $invoice = Billing::findorFail($billing_id);
        $date_generated = date('F d, Y H:i A');
        $my = $invoice->monthyear;
        $PDF = PDF::loadView('reports.pdf_billinginvoice', ['invoice'=>$invoice, 'date_generated'=>$date_generated])->setPaper('portrait');
        /*->setOptions(['defaultFont'=>'Helvetica']);*/
        return $PDF->stream();
    }
}
