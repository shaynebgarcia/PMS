<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
use App\OtherIncome;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use PDF;

class BillingController extends Controller
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
        $payments = Payment::where('property_id', $property->id)->get();
        $billings = Billing::where('property_id', $property->id)->get();

        return view('pages.billing.index', compact('property', 'billings', 'payments'));
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
    public function group($link, $id)
    {
        $property = Property::findorFail($this->property);
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
        $end      = (new DateTime($lease_detail->term_end))->modify('first day of next month');
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
    public function display($link, $lease_id, Billing $billing, $billing_my)
    {

        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($lease_id);

        $now = Carbon::now();

        //GET last bill under this property to get INVOICE NO
        $last_bill_property = Billing::where('property_id', $property->id)->where('leasing_agreement_details_id', $lease_detail->id)->latest()->first();
        if ($last_bill_property != null) {
            $invoice_no = date('y', strtotime($now)).$property->code.'-'.sprintf(config('pms.billing.invoice.num_filter'), $last_bill_property->id + 1);
        } else {
            $invoice_no = date('y', strtotime($now)).$property->code.'-'.sprintf(config('pms.billing.invoice.num_filter'), 1);
        }
        
        //CHECK if this is first billing invoice
        $last_bill = Billing::where(['leasing_agreement_details_id' => $lease_detail->id, 'monthyear'=> MY('-1 month', strtotime($billing_my))])->first();
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
        
        $bill_month_now = $now->format('MY');
        // $bill_month_next = date('MY', strtotime('+1 month', strtotime($now)));
        $bill_month_next = MY('+1 month', strtotime($lease_detail->first_day));

        $bill_from = $lease_detail->bill_from($billing_my);
        $bill_to = $lease_detail->bill_to($bill_from);
        $bill_due = $lease_detail->bill_due($bill_from);
        $bill_date = $lease_detail->bill_date($now);

        //GET Services and Utility Bill
        // $latest_sub_services = Service::where('leasing_agreement_details_id', $lease_detail->id)->get();
        $latest_sub_services = Service::where(['leasing_agreement_details_id' => $lease_detail->id, 'to_bill' => $billing_my])->get();
        // ->whereBetween('start_date', [Ymd($bill_from), Ymd($bill_to)])->orWhereBetween('end_date', [Ymd($bill_from), Ymd($bill_to)])->get();

        // dd($latest_sub_services);
        $utility_bill = UtilityBill::where(['leasing_agreement_details_id' => $lease_detail->id, 'to_bill' => $billing_my])->get();
        $other_bill = OtherIncome::where(['leasing_agreement_details_id' => $lease_detail->id, 'to_bill' => $billing_my])->get();


        $subtotal_subservices = $lease_detail->subtotal_subservices($latest_sub_services);
        $subtotal_utilitybill = $lease_detail->subtotal_utilitybill($utility_bill);
        $subtotal_incomebill = $lease_detail->subtotal_incomebill($other_bill);
        //CHECK if agreement term will expire this month
        if (strtotime($lease_detail->last_billing_my) <= strtotime($billing_my)) {
            $rental_price = 0;
            $subtotal_array = [$subtotal_subservices, $subtotal_utilitybill, $subtotal_incomebill];
        } else {
            $rental_price = $lease_detail->rental_price();
            $subtotal_array = [$rental_price, $subtotal_subservices, $subtotal_utilitybill, $subtotal_incomebill];
        }
        $subtotal = $lease_detail->subtotal($subtotal_array);
        $OUpayment = $lease_detail->oupayment($ou);
        $total = $lease_detail->total($subtotal, $ou);

        return view('pages.billing.display', compact(   'property',
                                                        'billing',
                                                        'last_bill',
                                                        'billing_my',
                                                        'lease',
                                                        'lease_detail',
                                                        'invoice_no',
                                                        'latest_sub_services',
                                                        'utility_bill',
                                                        'other_bill',
                                                        'bill_month_now',
                                                        'bill_month_next',
                                                        'now',
                                                        'prev_billing_payment',
                                                        'bill_from', 'bill_to', 'bill_due', 'bill_date',
                                                        'rental_price', 'subtotal_subservices', 'subtotal_utilitybill', 'subtotal', 'OUpayment', 'total'
                                                        ));
    }
    public function publish(Request $request, $link, $lease_id, Billing $billing, $billing_my)
    {
        $request->validate([
            'prepared_by' => 'required',
        ]);

        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_details = LeasingAgreementDetail::findorFail($lease_id);

        $now = Carbon::now();

        //GET last bill under this property to get INVOICE NO
        $last_bill_property = Billing::where('property_id', $property->id)->where('leasing_agreement_details_id', $lease_details->id)->latest()->first();
        if ($last_bill_property != null) {
            $invoice_no = date('y', strtotime($now)).$property->code.'-'.sprintf(config('pms.billing.invoice.num_filter'), $last_bill_property->id + 1);
        } else {
            $invoice_no = date('y', strtotime($now)).$property->code.'-'.sprintf(config('pms.billing.invoice.num_filter'), 1);
        }

        //GET Last Bill and Pyament Details
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
        

        $bill_month_now = $now->format('MY');

        $bill_from = $lease_details->bill_from($billing_my);
        $bill_to = $lease_details->bill_to($bill_from);
        $bill_due = $lease_details->bill_due($bill_from);
        $bill_date = $lease_details->bill_date($now);

        $latest_sub_services = Service::where('leasing_agreement_details_id', $lease_details->id)->whereBetween('start_date', [date($bill_from), date($bill_to)])->get();
        $utility_bill = UtilityBill::where(['leasing_agreement_details_id' => $lease_details->id, 'to_bill' => $billing_my])->get();
        $other_bill = OtherIncome::where(['leasing_agreement_details_id' => $lease_details->id, 'to_bill' => $billing_my])->get();

        $rental_price = $lease_details->rental_price();
        $subtotal_subservices = $lease_details->subtotal_subservices($latest_sub_services);
        $subtotal_utilitybill = $lease_details->subtotal_utilitybill($utility_bill);
        $subtotal_array = [$rental_price, $subtotal_subservices, $subtotal_utilitybill];
        $subtotal = $lease_details->subtotal($subtotal_array);
        $OUpayment = $lease_details->oupayment($ou);
        $total = $lease_details->total($subtotal, $ou);



        // Publishing bill
            $bill_published = Billing::updateOrCreate(
                [
                    'property_id' => $property->id,
                    'leasing_agreement_details_id' => $lease_id,
                    'monthyear' => $billing_my
                ],
                [
                    'leasing_agreement_details_id' => $lease_id,
                    'invoice_no' => $invoice_no,
                    'prepared_by' => $request->prepared_by,
                    'monthyear' => $billing_my,
                    'billing_to' => Ymd($bill_to),
                    'billing_from' => Ymd($bill_from),
                    'billing_date' => $now,
                    //Billing $bill_due will deduct (7) days from the $billing_to
                    // 'due_date' => Ymd($bill_due),
                    'due_date' => Ymd($bill_from),
                    'subtotal_amount' => $subtotal,
                    'ou_amount' => $OUpayment,
                    'total_amount_due' => $total,
                ]
            );

            if ($bill_published) {
                BillingDetail::updateOrCreate(
                    [
                        'billing_id' => $bill_published->id,
                        'type' => 'Rental',
                        'description' => 'Rental',
                    ],
                    [
                        'billing_id' => $bill_published->id,
                        'type' => 'Rental',
                        'description' => 'Rental',
                        'amount' => $rental_price,
                    ]
                );
                foreach ($latest_sub_services as $bill) {
                    // $type = ServiceType::where('id', $bill->service_type_id)->first();
                    BillingDetail::updateOrCreate(
                        [
                            'billing_id' => $bill_published->id,
                            'type' => 'Service',
                            'description' => $bill->service_type->name,
                        ],
                        [
                            'billing_id' => $bill_published->id,
                            'type' => 'Service',
                            'description' => $bill->service_type->name,
                            'amount' => $bill->agreed_amount,
                            'created_at' => $now,
                        ]
                    );
                }
                foreach ($utility_bill as $bill) {
                    // $type = UtilityType::where('id', $bill->utility_id)->first();
                    BillingDetail::updateOrCreate(
                        [
                            'billing_id' => $bill_published->id,
                            'type' => 'Utility',
                            'description' => $bill->utility->type,
                        ],
                        [
                            'billing_id' => $bill_published->id,
                            'type' => 'Utility',
                            'description' => $bill->utility->type,
                            'amount' => $bill->amount,
                            'created_at' => $now,
                        ]
                    );
                }
                foreach ($other_bill as $bill) {
                    // $type = UtilityType::where('id', $bill->utility_id)->first();
                    BillingDetail::updateOrCreate(
                        [
                            'billing_id' => $bill_published->id,
                            'type' => 'Other',
                            'description' => $bill->income_type->type,
                        ],
                        [
                            'billing_id' => $bill_published->id,
                            'description' => $bill->income_type->type,
                            'amount' => $bill->total_amount,
                            'created_at' => $now,
                        ]
                    );
                }
                Alert::success('Billing invoice has been published', 'Published!')->persistent('Close');
                return redirect()->route('export.invoice', [$property->code, $link, $lease_id, $bill_published->id]);
            } else {
                Alert::warning('Billing invoice failed to publish', 'Oops!')->persistent('Close');
                return redirect()->route('billing.group.lease', [$property->code, $link, $lease_id]);
            }
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

    public function exportPDF_invoice($link, $lease_id, $billing_id)
    {
        $property = Property::findorFail($this->property);
        $invoice = Billing::findorFail($billing_id);
        $date_generated = date('F d, Y H:i A');
        $my = $invoice->monthyear;
        $PDF = PDF::loadView('reports.pdf_billinginvoice', ['invoice'=>$invoice, 'date_generated'=>$date_generated])->setPaper('portrait');
        return $PDF->stream();
    }
}
