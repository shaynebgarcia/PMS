<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\LeasingAgreement;
use App\Payment;
use App\PaymentType;
use App\Tenant;
use App\Property;
use App\File;

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
        return view('pages.payment.index', compact('payments'));
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
        return view('pages.payment.create', compact('leases', 'properties', 'types', 'tenants'));
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
            'amount' => 'required',
            'reference_no' => 'nullable',
            'note' => 'nullable',
            'payment_file' => 'nullable',
        ]);

        // Creating payment
            $payment_stored = Payment::create([
                // 'agreement_id' => $request->agreement_id,
                'tenant_id' => $request->tenant,
                'payment_type_id' => $request->payment_type,
                'amount' => $request->amount,
                'reference_no' => $request->reference_no,
                'note' => $request->note,
                'processed_by_user' => auth()->user()->id,
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
