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
        $utilities = Utility::all();
        $billings = Billing::all();

        $now = Carbon::now();

        return view('pages.lease.index', compact('property', 'leases', 'details', 'property_access', 'payments', 'services', 'utilities', 'billings', 'now'));
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
        $tenants = Tenant::all();
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
            'tenant' => 'required',
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
            'link_id' => $property->code.$request->unit.$request->tenant,
            'property_id' => $property->id,
            'tenant_id' => $request->tenant,
            'unit_id' => $request->unit,
            'agreement_status_id' => 1,
        ]);

        if ($agreement_stored) {

            $agreement_stored->update([
                'link_id' => $agreement_stored->unit_id.$agreement_stored->tenant_id.'-'.$agreement_stored->id,
            ]);

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

                'status' => 'Active',
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
                                $service_price = $service->monthly_rate;
                            } else {
                                $service_price = floatval($request->amounts[$item]);
                            }
                            // Create each service subscription
                            $array = array (
                                'leasing_agreement_details_id' => $agreement_details_stored->id,
                                'service_type_id' => $request->subscriptions[$item],
                                'agreed_monthly_rate' => $service_price,
                            );
                            $new_sub_id = Service::create($array)->id;
                        }
                    }
                }
                // Check and update if there is payments applied
                if ($request->reservation != null) {
                    $payment = Payment::where('id', $request->reservation)->first();
                    $payment_updated = $payment->update(['leasing_agreement_details_id' => $agreement_stored->id]);
                }
            }
                
            // Updating tenant role
            $tenant = Tenant::where('id', $agreement_stored->tenant_id)->first();
            $user = User::where('id', $tenant->user_id)->first();
            $user_updated = $user->update([
                'role_id' => 8,
            ]);

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
