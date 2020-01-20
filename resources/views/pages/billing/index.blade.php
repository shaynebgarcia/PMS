@extends('layouts.admindek', ['pageSlug' => 'billing-index'])

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
					<table id="cbtn-selectors" class="table table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                            	<th class="{{ config('pms.table.th.font-size') }}"></th>
	                            	<th class="{{ config('pms.table.th.font-size') }} bg-highlight">Agreement</th>
	                            	<th class="{{ config('pms.table.th.font-size') }} bg-highlight">Unit</th>
	                            	<th class="{{ config('pms.table.th.font-size') }} bg-highlight">Tenant</th>
	                            	<th class="{{ config('pms.table.th.font-size') }}">Invoice NO</th>
	                            	<th class="{{ config('pms.table.th.font-size') }}">Month</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Billing Date</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Rental Due Date</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Date Start/End</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Rent</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Utilities</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Services</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Other</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Sub-total</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Prev. O/U</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Total Amount Due</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Total Collected</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">O/U-Payment</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">PR#</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">PR# Date</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Notice</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($billings as $bill)
                        		{{-- Payments --}}
                                @php
                            		$bill_payment = $payments->where('billing_id', $bill->id)->first();
                            	@endphp
	                            <tr @if($bill_payment == null) style="background-color: #f9e596" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="" data-original-title="INVOICE UN-PAID" @endif>
	                            	<td class="{{ config('pms.table.td.font-size') }}">
	                                    <a href="{{ route('export.invoice', [$property->code, $bill->leasing_agreement_details_id, $bill->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Invoice">
	                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
	                                    </a>
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight f-w-700">
	                                	{{ $bill->leasing_agreement_details->agreement_no }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
	                                	{{ $bill->leasing_agreement_details->agreement->unit->number }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                        @foreach($bill->leasing_agreement_details->agreement->tenant_list as $tl)
                                            {{ $tl->tenant->user->lnamefname }}<br>
                                        @endforeach
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ $bill->invoice_no }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ FY($bill->monthyear) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ MdY($bill->billing_date) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ MdY($bill->due_date) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ MdY($bill->billing_from) }} - {{ MdY($bill->billing_to) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->details->where('type', 'Rental')->sum('amount')) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->details->where('type', 'Utility')->sum('amount')) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->details->where('type', 'Service')->sum('amount')) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->details->where('type', 'Other')->sum('amount')) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->subtotal_amount) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->ou_amount) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ currencysign($bill->total_amount_due) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	@if($bill_payment != null)
	                                		{{ currencysign($bill_payment->amount_paid) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	@if($bill_payment != null)
	                                		{{ currencysign($bill_payment->amount_paid - $bill->total_amount_due) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	@if($bill_payment != null)
	                                		{{ $bill_payment->reference_no }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	@if($bill_payment != null)
	                                		{{ MdY($bill_payment->date_paid) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
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
	                                		{{ \Carbon\Carbon::createFromDate($bill->due_date)->diffInDays(\Carbon\Carbon::now()) }} day(s) overdue
	                                	@endif
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                        </a>
	                                </td>
	                            </tr>
	                        @endforeach
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