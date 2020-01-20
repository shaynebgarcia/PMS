<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\PropertyAccess;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Payment;
use App\PaymentType;
use App\Billing;
use App\Tenant;
use App\Property;
use App\File;

use Carbon\Carbon;
use Alert;
use Storage;

class PaymentController extends Controller
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
        $payments = Payment::where('property_id', $property->id)->get();
        $files = File::where('model', 'Payment')->get();
        $property_access = PropertyAccess::all();
        return view('pages.payment.index', compact('property', 'payments', 'files', 'property_access'));
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
        $lease_details = LeasingAgreementDetail::where('property_id', $property->id)->get();
        $tenants = Tenant::all();
        $properties = Property::all();
        $types = PaymentType::all();
        $bills = Billing::all();
        return view('pages.payment.create', compact('property', 'leases', 'lease_details', 'properties', 'types', 'tenants', 'bills'));
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

        $property = Property::findorFail($this->property);

        // Creating payment
            $payment_stored = Payment::create([
                'property_id' => $property->id,
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
            $payment_stored->update(['slug' => config('pms.unique_prefix.payment').$payment_stored->id]);

            // if (request()->hasFile('payment_file')) {
            //     $file_stored = File::create([   'name' => 'Payment',
            //                                     'model' => 'Payment',
            //                                     'path' => $request->file('payment_file')->store('payments')
            //                                 ]);
            //     $payment_stored->update([   'file_id' => $file_stored->id
            //                             ]);
            // }

            // Handle File Upload
            if($request->hasFile('payment_file')){
                // Get filename with the extension
                $filenameWithExt = $request->file('payment_file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('payment_file')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $file_stored = File::create([   'name' => 'Payment',
                                                'model' => 'Payment',
                                                'path' => $request->file('payment_file')->storeAs('payments', $fileNameToStore)
                                            ]);
                $payment_stored->update([   'file_id' => $file_stored->id
                                        ]);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            if (!$payment_stored) {
                Alert::error('Encountered an error', 'Oops')->persistent('Close');
                return redirect()->route('payment.create');
            } else {
                Alert::success('Payment creation complete '.$payment_stored->slug, 'Success')->persistent('Close');
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
        $property = Property::findorFail($this->property);
        $payment = Payment::where('slug', $slug)->first();
        $leases = LeasingAgreement::where('property_id', $property->id)->get();
        $lease_details = LeasingAgreementDetail::where('property_id', $property->id)->get();
        $tenants = Tenant::all();
        $properties = Property::all();
        $types = PaymentType::all();
        $bills = Billing::all();
        return view('pages.payment.edit', compact('property', 'payment', 'leases', 'lease_details', 'properties', 'types', 'tenants', 'bills'));
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

        $payment = Payment::where('slug', $slug)->first();
        // Creating payment
            $payment_update = $payment->update([
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

            // Handle File Upload
            if($request->hasFile('payment_file')){
                // Get filename with the extension
                $filenameWithExt = $request->file('payment_file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('payment_file')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;

                $file = File::where('id', $payment->file_id)->first();
                // Upload Image
                $file_update = $file->update([  'name' => 'Payment',
                                                'model' => 'Payment',
                                                'path' => $request->file('payment_file')->storeAs('payments', $fileNameToStore)
                                             ]);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            if (!$payment_update) {
                Alert::error('Encountered an error', 'Oops')->persistent('Close');
                return redirect()->back();
            } else {
                Alert::success('Payment update complete '.$slug, 'Success')->persistent('Close');
                return redirect()->route('payment.index');
            }
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

    public function group($link, $id)
    {
        $property = Property::findorFail($this->property);
        $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);
        $null_payments = Payment::where('leasing_agreement_details_id', null)->get();
        $payments = Payment::where('leasing_agreement_details_id', $id)->get();
        $now = Carbon::now();
        return view('pages.payment.group', compact('property', 'lease', 'lease_detail', 'payments', 'null_payments'));
    }

    public function attach(Request $request, $link, $id)
    {
        $request->validate([
            'payment_attach' => 'required',
        ]);

        // $property = Property::where('code', $code)->first();
        // $lease = LeasingAgreement::findorFail($link);
        $lease_detail = LeasingAgreementDetail::findorFail($id);

        $payment = Payment::findorFail($request->payment_attach);
        $update = $payment->update([
            'leasing_agreement_details_id' => $id
        ]);

        Alert::success('Payment has been attached', 'Success');
        return redirect()->route('payment.group.lease', [$link, $id]);
    }
}
