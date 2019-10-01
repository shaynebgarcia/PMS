<?php

namespace App\Http\Controllers;

use App\LeasingAgreement;
use App\LeasingAgreementType;
use App\LeasingPayable;
use App\PaymentType;
use Illuminate\Http\Request;

class LeasingPayableController extends Controller
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
    public function create($id)
    {
        $lease = LeasingAgreement::findorFail($id);
        $types = PaymentType::all();
        return view('pages.lease.payable.create', compact('lease', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $lease = LeasingAgreement::findorFail($id);

        $request->validate([
            'payable_type' => 'required',
            'amount' => 'required',
        ]);

        // Creating payables
            $payable_stored = LeasingPayable::create([
                'agreement_id' => $lease->id,
                'payment_type_id' => $request->payable_type,
                'amount' => $request->amount,
            ]);

        if (!$payable_stored) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('payable.create', $id);
        } else {
            return redirect()->route('payable.create', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeasingPayable  $leasingPayable
     * @return \Illuminate\Http\Response
     */
    public function show(LeasingPayable $leasingPayable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeasingPayable  $leasingPayable
     * @return \Illuminate\Http\Response
     */
    public function edit(LeasingPayable $leasingPayable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeasingPayable  $leasingPayable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeasingPayable $leasingPayable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeasingPayable  $leasingPayable
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeasingPayable $leasingPayable)
    {
        //
    }
}
