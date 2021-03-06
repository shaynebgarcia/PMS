@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.bill.icon');
        $breadcrumb_title = config('pms.breadcrumbs.bill.bill-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.bill.bill-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-bill', $property, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	<div class="card">
    		<div class="card-header">
                <h5>Contracts</h5>
            </div>
            <div class="card-block">
	            @if(count($leases) > 0)
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
	                        @foreach($leases as $lease)
	                            <tr>
	                            	<td class="f-12">
	                                    <a href="{{ route('export.invoice', [$property->code, $lease_detail->id, $bill->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Invoice">
	                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
	                                    </a>
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->invoice_no }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('F Y', strtotime($bill->monthyear)) }} <br>
	                                	<p class="f-10"> {{ date('M d, Y', strtotime($bill->billing_from)) }} - {{ date('M d, Y', strtotime($bill->billing_to)) }} </p>
	                                </td>
	                                <td class="f-12">
	                                	{{ date('M d, Y', strtotime($bill->billing_date)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('M d, Y', strtotime($bill->due_date)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->subtotal_currency_sign }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->ou_currency_sign }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $bill->total_currency_sign  }}
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
	                                		{{ config('pms.currency.sign').number_format($bill_payment->amount_paid - $bill->total_amount_due, 2) }}
	                                	@else
	                                		No Payment
	                                	@endif
	                                </td>
	                                <td class="f-12">
	                                	@if($bill_payment != null)
	                                		<a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Payment"> {{ $bill_payment->reference_no }} </a> <br>
	                                		({{ date('M d, Y', strtotime($bill_payment->date_paid)) }})
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
		        var lease = $("#lease_d_id").val();
		        console.log(monthyear);
		        $("#gen_prev_bill_btn").attr("href", "/property/"+property+"/lease/"+lease+"/bill/"+ monthyear);
		    });
		});
	</script>
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-js')
@endsection