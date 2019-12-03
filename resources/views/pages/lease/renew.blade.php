@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.formmasking-css')
    @include('includes.plugins.formpicker-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.lease.icon');
        $breadcrumb_title = config('pms.breadcrumbs.lease.lease-renew.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.lease.lease-renew.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-renew', $property, $lease) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<form id="lease-renew" method="POST" action="{{ route('lease.renew', [$property->code, $lease->id]) }}">
	        @CSRF
		        <div class="row">
		        	<div class="col-lg-6 col-md-6 col-sm-6">
			            <div class="card">
			                <div class="card-header">
			                    <h5>Property/Unit</h5>
			                </div>
			                <div class="card-block">
			                    {{-- SELECT Property --}}
			                    <div class="form-group row">
			                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property/Unit</label>
			                            <div class="col-lg-10 col-md-10 col-sm-10">
			                            	<input type="text" class="form-control" name="property" value="{{ $property->name }} - {{ $lease->unit->number }}" readonly>
			                            </div>
			                    </div>
			                    {{-- SELECT Tenant --}}
			                    <div class="form-group row">
			                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Tenant</label>
			                            <div class="col-lg-10 col-md-10 col-sm-10">
			                            	<input type="text" class="form-control" name="property" value="{{ $lease->tenant->user->fullnamewm }}" readonly>
			                            </div>
			                    </div>
			                </div>
			            </div>
		        	</div>
		        	<div class="col-lg-6 col-md-6 col-sm-6">
			            <div class="card">
			                <div class="card-header">
			                    <h5>Current/Previous Agreement Details</h5>
			                </div>
			                <div class="card-block">
			                	<h6>Leasing Agreement ID: {{ $lease->details->last()->agreement_no }}</h6>
			                	<h6>Type/Status: {{ $lease->details->last()->description }}</h6>
			                	<h6>Lease Price: {{ $lease->details->last()->agreed_lease_price_currency_sign }}</h6>
					        	{{-- <h6>Property: {{ $lease->name }}</h6>
					        	<h6>Unit: {{ $lease->unit->number }}</h6>
					        	<h6>Tenant: {{ $lease->tenant->user->fullnamewm }}</h6> --}}
			                </div>
			            </div>
			        </div>
		        </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Leasing Agreements (Renewing)</h5>
	                </div>
	                <div class="card-block">
	                	{{-- INPUT Date of Execution --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date of Execution</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="execution_date">
	                                @error('execution_date')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
	                    </div>
	                    {{-- INPUT Lease Price --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Rent (Monthly)</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                                <div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
	                                    </span>
	                                    <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="agreed_lease_price" value="" placeholder="Override lease price here. Leave blank to keep default leasing price">
	                                    @error('agreed_lease_price')
	                                        <span class="messages">
	                                            <p class="text-danger error">{{ $message }}</p>
	                                        </span>
	                                    @enderror
	                                </div>
	                            </div>
	                    </div>
	                    {{-- INPUT Term Start-End --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term Start</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="term_start">
	                                @error('term_start')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term End</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="term_end">
	                                @error('term_end')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
	                    </div>
	                    {{-- SELECT Term DURATION --}}
	                    <div class="form-group row">
	                    	<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term Duration</label>
	                    	<div class="col-lg-4 col-md-4 col-sm-4">
	                    		<select name="term_duration" class="js-example-basic-single" style="width:100%;">
                                    <option disabled selected value>Select Month(s)</option>
                                        <option value="6">6 months</option>
                                        <option value="12">12 months</option>
                                 </select>
                                 @error('term_duration')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
	                    	</div>
	                    </div>
	                </div>
	            </div>

	            {{-- SELECT TABLE Subscription Services --}}
	            <div class="card">
	            	<div class="card-header">
	                    <h5>Service Subscriptions</h5>
	                </div>
	                <div class="card-block">
	                	<table class="table table-sm" id="itemtable">
                             <thead>
                                 <tr>
                                    <th width="40%">Subscriptions</th>
                                    <th width="20%">Amount</th>
                                    <th width="10%">
                                    	<a href="#" id="addrow">
                                    		<button class="btn waves-effect waves-light btn-success btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-plus"></i>
	                                    	</button>
                                    	</a>
                                    </th>
                                 </tr>
                             </thead>
                             <tbody>
                               <tr>
                                <td>
                                  <select name="subscriptions[]" class="js-example-basic-single" style="width:100%;">
                                    <option disabled selected value>Select Service(s)</option>
                                      @foreach ($services->where('is_subscription', true) as $subscription)
                                        <option value="{{ $subscription->id }}">{{ $subscription->name }} ({{ $subscription->monthly_price_length }})</option>
                                      @endforeach
                                  </select>
                                </td>
                                <td>
                                	<div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
	                                    </span>
	                                    <input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}">
	                                </div>
                                </td>
                                <td>
                                	<a href="#" id="btnDel">
                                		<button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-minus"></i>
	                                    </button>
                                    </a>
                                </td>
                               </tr>
                             </tbody>
                          </table>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Payment</h5>
	                </div>
	                <div class="card-block">
	                    {{-- SELECT Property --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Deposit</label>
	                            <div class="col-lg-9 col-md-9 col-sm-9">
	                                <select class="select2" name="reservation" style="width: 100%">
	                                    <option value="#" disabled selected>Select Payment</option>
	                                    @foreach($payments->where('payment_type_id', 1) as $payment)
                                            <option value="{{ $payment->id }}">
                                                {{ $payment->payment_type->name }} - {{ $payment->reference_no }} ({{ $payment->date_paid }}) | {{ $payment->tenant->user->fullnamewm }} ({{ $payment->amount_currency_sign }})
                                            </option>
	                                    @endforeach
	                                </select>
	                            </div>
	                            <div class="col-lg-1 col-md-1 col-sm-1">
	                                <a href="{{ route('payment.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Create Payment">
	                                    <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-credit-card fa-lg"></i>
	                                    </button>
	                                </a>
	                            </div>
	                    </div>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Billing</h5>
	                </div>
	                <div class="card-block">
	                	{{-- INPUT Monthly Due/Collection --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Pay Period</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                            	<div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">Every</label>
	                                    </span>
	                                    <input type="number" min=1 max=31 class="form-control" name="monthly_due">
	                                    <span class="input-group-append">
											<label class="input-group-text">of the month</label>
										</span>
	                                </div>
	                                @error('monthly_due')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
	                            </div>
	                    </div>
	                    {{-- INPUT Move-in/First Day --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date Start of Billing</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="first_day">
	                            </div>
	                    </div>
	                </div>
	            </div>

                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.formmasking-js')
    @include('includes.plugins.formpicker-js')
    @include('includes.custom-scripts.multi-subscriptions')
@endsection

