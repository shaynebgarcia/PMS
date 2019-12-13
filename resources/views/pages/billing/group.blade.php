@extends('layouts.admindek', ['pageSlug' => 'billing-group'])

@section('css-plugin')
	@include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.bill.icon');
        $breadcrumb_title = config('pms.breadcrumbs.bill.bill-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.bill.bill-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-bill', $property, $lease, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	<div class="card">
            <div class="card-block">
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Generate Next Bill</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        	<a href="{{ route('billing.display', [$lease->id, $lease_detail->id, $bill_this])}}">
			            		<button class="btn btn-primary btn-sm">{{ FY($bill_this) }}</button>
			            	</a>
			            	<input id="property_id" value="{{ $property->code }}" hidden>
			            	<input id="lease_id" value="{{ $lease_detail->agreement->id }}" hidden>
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
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Generate Bill</label>
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
    	</div>
    	<div class="card">
    		<div class="card-header">
                <h5>Published Invoice</h5>
            </div>
            <div class="card-block">
	            @if(count($billings) > 0)
	                <div>
	                    <table id="order-table" class="table table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                            	<th class="f-12"></th>
	                                <th class="f-12">Invoice NO</th>
	                                <th class="f-12">Month</th>
	                                <th class="f-12">Billing Date</th>
	                                <th class="f-12">Due Date</th>
	                                <th class="f-12">Sub-total</th>
	                                <th class="f-12">Prev. O/U</th>
	                                <th class="f-12">Total Amount Due</th>
	                                <th class="f-12">Total Collected</th>
	                                <th class="f-12">O/U-Payment</th>
	                                <th class="f-12">PR#/Date</th>
	                                <th class="f-12">Notice</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($billings as $bill)
	                            <tr>
	                            	<td class="f-12">
	                                    <a href="{{ route('export.invoice', [$lease->id, $lease_detail->id, $bill->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Invoice">
	                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
	                                    </a>
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->invoice_no }}
	                                </td>
	                                <td class="f-12">
	                                	{{ FY($bill->monthyear) }} <br>
	                                	<p class="f-10"> {{ MdY($bill->billing_from) }} - {{ MdY($bill->billing_to) }} </p>
	                                </td>
	                                <td class="f-12">
	                                	{{ MdY($bill->billing_date) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ MdY($bill->due_date) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ currencysign($bill->subtotal_amount) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ currencysign($bill->ou_amount) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ currencysign($bill->total_amount_due)  }}
	                                </td>
	                                {{-- Payments --}}
	                                @php
                                		$bill_payment = $payments->where('billing_id', $bill->id)->first();
                                	@endphp
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ $bill_payment->amount_paid_currency_sign ?? 'None' }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		{{ currencysign($bill_payment->amount_paid - $bill->total_amount_due) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		<a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Payment"> {{ $bill_payment->reference_no }} </a> <br>
	                                		({{ MdY($bill_payment->date_paid) }})
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
	<script>
		$(document).ready(function(){
			$("#gen_prev_bill").change(function(){
		        var monthyear = $(this).val();
		        var property = $("#property_id").val();
		        var link = $("#lease_id").val();
		        var lease = $("#lease_d_id").val();
		        console.log(link);
		        $("#gen_prev_bill_btn").attr("href", "/lease/"+link+"/"+lease+"/billing/"+ monthyear);
		    });
		});
	</script>
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-js')
@endsection