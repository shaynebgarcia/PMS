<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\PropertyAccess;
use App\LeasingAgreement;
use App\Payment;
use App\PaymentType;
use App\Billing;
use App\Tenant;
use App\Property;
use App\File;

use Carbon\Carbon;
use Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        $property_access = PropertyAccess::all();
        return view('pages.payment.index', compact('payments', 'property_access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leases = LeasingAgreement::all();
        $tenants = Tenant::all();
        $properties = Property::all();
        $types = PaymentType::all();
        $bills = Billing::all();
        return view('pages.payment.create', compact('leases', 'properties', 'types', 'tenants', 'bills'));
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
            'tenant' => 'required',
            'payment_type' => 'required',
            'amount_due' => 'required',
            'amount_paid' => 'required',
            'date_payment' => 'required',
            'reference_no' => 'nullable',
            'note' => 'nullable',
            'payment_file' => 'nullable',
            'agreement' => 'nullable',
            'bill' => 'required_if:payment_type,1',
        ]);

        // Creating payment
            $payment_stored = Payment::create([
                'leasing_agreement_details_id' => $request->agreement,
                'billing_id' => $request->bill,
                'tenant_id' => $request->tenant,
                'payment_type_id' => $request->payment_type,
                'amount_due' => $request->amount_due,
                'amount_paid' => $request->amount_paid,
                'reference_no' => $request->reference_no,
                'note' => $request->note,
                'processed_by_user' => auth()->user()->id,
                'date_paid' => $request->date_payment,
            ]);

            // Updating slug payment
            $payment_stored->update(['slug' => 'payment-'.$payment_stored->id]);

            if (request()->hasFile('payment_file')) {
                $file_stored = File::create([   'name' => 'Payment',
                                                'path' => $request->file('payment_file')->store('payments')
                                            ]);
                $payment_stored->update([   'file_id' => $file_stored->id
                                        ]);
            }

            if (!$payment_stored) {
                Alert::error('Encountered an error', 'Oops')->persistent('Close');
                return redirect()->route('payment.create');
            } else {
                Alert::success('Payment creation complete', 'Success')->persistent('Close');
                return redirect()->route('payment.index');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
    }
}
