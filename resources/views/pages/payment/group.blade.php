@extends('layouts.admindek', ['pageSlug' => 'payment-group'])

@section('css-plugin')
	@include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.payment.icon');
        $breadcrumb_title = config('pms.breadcrumbs.payment.payment-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.payment.payment-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-payment', $property, $lease, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	<div class="card">
			<div class="card-header">
	            <h5>Payment List</h5>
	        </div>
	        <div class="card-block">
	        	<h6>Leasing Agreement ID: {{ $lease_detail->agreement_no }}</h6>
	        	<h6>Property: {{ $property->name }}</h6>
	        	<h6>Unit: {{ $lease->unit->number }}</h6>
	        	<h6>Tenant: {{ $lease->tenant->user->fullnamewm }}</h6>
	        </div>
	    </div>
	    <div class="card">
			<div class="card-header">
	            <h5>Attach Payment</h5>
	        </div>
	        <div class="card-block">
	        	<form id="attach-payment" method="POST" action="{{ route('payment.attach', [$property->code, $lease->id, $lease_detail->id]) }}" enctype="multipart/form-data">
        			@CSRF @METHOD('PATCH')
	            	<div class="form-group row">
	            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Payment to Attach</label>
	                        <div class="col-lg-7 col-md-7 col-sm-7">
	                        	<select class="select2" name="payment_attach" style="width: 100%" required>
	                                <option value="#" disabled selected>Select a Payment</option>
										@foreach($null_payments as $payment)
		                                    <option value="{{ $payment->id }}">
		                                        {{ $payment->id }}
		                                    </option>
										@endforeach
	                            </select>
	                            @error('payment_attach')
	                                <span class="messages">
	                                    <p class="text-danger error">{{ $message }}</p>
	                                </span>
	                            @enderror
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2">
	                        	<button type="submit" class="btn btn-primary btn-sm">Attach</button>
	                        </div>
	            	</div>
            	</form>
	        </div>
	    </div>
    	<div class="card">
    		<div class="card-header">
                <h5>Payments</h5>
            </div>
            <div class="card-block">
	            @if(count($payments) > 0)
	                <div>
	                    <table id="order-table" class="table table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                                <th class="f-12">ID</th>
	                                <th class="f-12">Payment Type</th>
	                                <th class="f-12">REF NO</th>
	                                {{-- <th>Tenant</th>
	                                <th>Unit</th> --}}
	                                <th class="f-12">Date Paid</th>
	                                <th class="f-12">Amount Due</th>
	                                <th class="f-12">Amount Paid</th>
	                                <th class="f-12">File</th>
	                                <th class="f-12">Date Created</th>
	                                <th class="f-12">Action</th>
	                            </tr>
	                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                @php
                                    $diff_percent = ($payment->amount_paid / $payment->amount_due) * 100 - 100;
                                    if ($payment->amount_due <= $payment->amount_paid) {
                                        $color = 'text-c-green';
                                        $text = '+'.round($diff_percent, 2).'%';
                                    } else {
                                        $color = 'text-c-red';
                                        $text = round($diff_percent, 2).'%';
                                    }
                                @endphp
                                <tr @if($payment->leasing_agreement_details_id == null) style="background-color: #f9e596" @endif>
                                    <td style="font-size: 13px; font-weight: bold">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                                {{ $payment->slug }}
                                            </a>
                                    </td>
                                    <td class="f-12">
                                        {{ $payment->payment_type->name }}
                                        @if($payment->billing_id != null)
                                            <br>
                                            <a href="">{{ $payment->bill->invoice_no }}</a>
                                        @endif
                                    </td>
                                    <td class="f-12">{{ $payment->reference_no }}</td>
                                    <td class="f-12">{{ $payment->date_paid }}</td>
                                    <td class="f-12">{{ $payment->amount_due_currency_sign }}</td>
                                    <td class="f-12">
                                        {{ $payment->amount_paid_currency_sign }}
                                        <span class="{{ $color }} f-w-700 m-l-10" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="%">{{ $text }}</span>
                                    </td>
                                    <td class="f-12"><img src="{{ Storage::url($payment->file) }}" height="30px" width="30px" /></td>
                                    <td class="f-12">{{ $payment->created_at }}</td>
                                    <td class="f-12">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                            <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                            <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
	                    </table>
	                </div>
	            @else
	                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
	                <small>No attached payment</small>
	            @endif
            </div>
    	</div>
	</div>
</div>
@endsection

@section('js-plugin')
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-js')
@endsection