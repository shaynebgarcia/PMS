<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\JobOrder;
use App\JobOrderLine;
use App\JobOrderProcessing;
use App\OtherIncome;
use App\OtherIncomeType;
use App\Inventory;

use Carbon\Carbon;
use Alert;
use DateTime;
use DateInterval;
use DatePeriod;

class JobOrderController extends Controller
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
        $orders = JobOrder::where('property_id', $property->id)->get();
        return view('pages.order.index', compact('property', 'orders'));
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
        $order_types = OtherIncomeType::where('for_workorder', 1)->get();
        // $leases = LeasingAgreementDetail::where('property_id', $property->id)->get();
        $inventories = Inventory::where('property_id', $property->id)->orwhere('property_id', null)->get();

        $now = Carbon::now();

        $start    = (new DateTime(date('d-M-Y', strtotime('-1 year', strtotime($now)))))->modify('first day of this month');
        $end      = (new DateTime(date('d-M-Y', strtotime('+1 year', strtotime($now)))))->modify('first day of this month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        return view('pages.order.create', compact('property', 'leases', 'order_types', 'inventories', 'period'));
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
            'to_bill' => 'required',
            'order_type' => 'required'
        ]);

        $property = Property::findorFail($this->property);

        $details = [
            'property_id' => $property->id,
            'leasing_agreement_details_id' => $request->agreement,
            'order_type_id' => $request->order_type,
            'to_bill' => $request->to_bill,
            'description' => $request->description,
            'notes' => $request->notes,
            'status_id' => 9,
        ];

        $newOrderID = JobOrder::create($details)->id;

        $newOrder = JobOrder::findorFail($newOrderID);
        $newOrder->update([ 'order_no' => config('pms.unique_prefix.order').$newOrderID ]);

        $processing = JobOrderProcessing::all();
        if (count($processing) > 0)
        {
            foreach($processing as $li) {
                $inventory_item = Inventory::where('id', $li->inventory_id)->first();
                JobOrderLine::create([
                    'job_order_id' => $newOrderID,
                    'inventory_id' => $li->inventory_id,
                    'price' => $inventory_item->price,
                    'qty' => $li->qty,
                    'total_price' => $inventory_item->price * $li->qty,
                ]);
            }

            $order_line_sum = JobOrderLine::where('job_order_id', $newOrderID)->sum('total_price');
            $newOrder->update([ 'total_amount' => $order_line_sum ]);

            //CLEAR PROCESSING ITEMS
            JobOrderProcessing::truncate();
        }

        // Creating other income
        $oincome_stored = OtherIncome::create([
            'leasing_agreement_details_id' => $request->agreement,
            'other_income_type_id' => 3,
            'to_bill' => $request->to_bill,
            'order_id' => $newOrderID,
            'total_amount' => $order_line_sum,
            // 'note' => $request->note,
        ]);

        if (!$oincome_stored) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->back();
        } else {
            Alert::success('Work order and attachment of other income completed', 'Success')->persistent('Close');
            return redirect()->route('orders.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function show(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOrder $jobOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOrder $jobOrder)
    {
        //
    }
}
