@extends('layouts.admindek')

@section('css-plugin')
	@include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.bill.icon');
        $breadcrumb_title = config('pms.breadcrumbs.bill.bill-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.bill.bill-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('bill', $property) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	{{-- <div class="card">
            <div class="card-block">
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Generate Bill</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        	<a href="{{ route('billing.display', [$property->code, $lease_detail->id, $bill_this])}}">
			            		<button class="btn btn-primary btn-sm">{{ date('F Y', strtotime($bill_this)) }}</button>
			            	</a>
			            	<input id="property_id" value="{{ $property->code }}" hidden>
			            	<input id="lease_d_id" value="{{ $lease_detail->id }}" hidden>
                        </div>
            	</div>
            	@php
            		$bill_from = $lease_detail->bill_from($bill_this);
            		$bill_due = $lease_detail->bill_due($bill_from);
            	@endphp
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Next Rental Due Date</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        	<h6>{{ $lease_detail->MdY('M', 'd', 'Y', $bill_from) }} ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($lease_detail->MdY('M', 'd', 'Y', $bill_from)))->diffForHumans() }})</h6>
                        </div>
                </div>
                <div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Next Billing Date</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        	<h6>{{ $bill_due }} ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($lease_detail->MdY('M', 'd', 'Y', $bill_due)))->diffForHumans() }})</h6>
                        </div>
                </div>
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Generate Previous Bill</label>
                        <div class="col-lg-7 col-md-7 col-sm-7">
                        	<select class="select2" id="gen_prev_bill" style="width: 100%">
                                <option value="#" disabled selected>Select Month</option>
									@foreach($period as $dt)
	                                    <option value="{{ $dt->format("MY") }}">
	                                        {{ $dt->format("F Y") }}
	                                    </option>
									@endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                        	<a id="gen_prev_bill_btn" href="#">
			            		<button class="btn btn-primary btn-sm">Generate</button>
			            	</a>
                        </div>
            	</div>
            </div>
    	</div> --}}
    	<div class="card">
    		<div class="card-header">
                <h5>Published Invoice</h5>
            </div>
            <div class="card-block">
	            @if(count($billings) > 0)
				<div class="dt-responsive">
					<table id="cbtn-selectors" class="table table-striped table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                            	<th class="f-12"></th>
	                            	<th class="f-12">Month</th>
	                                <th class="f-12">Invoice NO</th>
	                                <th class="f-12">Billing Date</th>
	                                <th class="f-12">Rental Due Date</th>
	                                <th class="f-12">Date Start/End</th>
	                                <th class="f-12">Unit</th>
	                                <th class="f-12">Rent</th>
	                                <th class="f-12">Utilities</th>
	                                <th class="f-12">Other</th>
	                                <th class="f-12">Sub-total</th>
	                                <th class="f-12">Prev. O/U</th>
	                                <th class="f-12">Total Amount Due</th>
	                                <th class="f-12">Total Collected</th>
	                                <th class="f-12">O/U-Payment</th>
	                                <th class="f-12">PR#</th>
	                                <th class="f-12">PR# Date</th>
	                                <th class="f-12">Notice</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($billings as $bill)
	                            <tr>
	                            	<td class="f-12">
	                                    <a href="{{ route('export.invoice', [$property->code, $bill->leasing_agreement_details_id, $bill->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Invoice">
	                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
	                                    </a>
	                                </td>
	                                <td class="f-12">
	                                	{{ date('F Y', strtotime($bill->monthyear)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->invoice_no }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('d-M-Y', strtotime($bill->billing_date)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('d-M-Y', strtotime($bill->due_date)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('d-M-Y', strtotime($bill->billing_from)) }} - {{ date('d-M-Y', strtotime($bill->billing_to)) }}
	                                </td>
	                                <td class="f-12">
	                                	@php
	                                		$bill_details = $all_bill->where('id', $bill->id)->first();
	                                	@endphp
	                                	{{ $bill_details->leasing_agreement_details->agreement->unit->number }}
	                                </td>
	                                <td class="f-12">
	                                </td>
	                                <td class="f-12">
	                                </td>
	                                <td class="f-12">
	                                </td>
	                                <td class="f-12">
	                                	{{ config('pms.currency.sign').number_format($bill->subtotal_amount, 2) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ config('pms.currency.sign').number_format($bill->ou_amount, 2) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ config('pms.currency.sign').number_format($bill->total_amount_due, 2) }}
	                                </td>
	                                {{-- Payments --}}
	                                @php
                                		$bill_payment = $payments->where('billing_id', $bill->id)->first();
                                	@endphp
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ config('pms.currency.sign').number_format($bill_payment->amount_paid, 2) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ config('pms.currency.sign').number_format($bill_payment->amount_paid - $bill->total_amount_due, 2) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ $bill_payment->reference_no }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ date('M d, Y', strtotime($bill_payment->date_paid)) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
		                                    @php
		                                    	$no_days = \Carbon\Carbon::createFromDate($bill->due_date)->diffInDays($bill_payment->date_paid);
		                                    @endphp
		                                    @if($bill_payment->date_paid > $bill->due_date)
		                                    	{{ $no_days }} day(s) overdue
		                                    @else
		                                    	{{ $no_days }} day(s) advanced
		                                    @endif
	                                	@else
	                                		{{ \Carbon\Carbon::createFromTimeStamp(strtotime($bill->due_date))->diffForHumans() }}
	                                	@endif
	                                </td>
	                            </tr>
	                        @endforeach
	                        {{-- <tr>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        </tr> --}}
	                        </tbody>
	                    </table>
	                </div>
	            @else
	                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
	                <small>No published bill</small>
	            @endif
            </div>
    	</div>
	</div>
</div>
@endsection

@section('js-plugin')
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-export-js')
@endsection