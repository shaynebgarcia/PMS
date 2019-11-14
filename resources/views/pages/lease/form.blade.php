@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.formmasking-css')
    @include('includes.plugins.formpicker-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.lease.icon');
        $breadcrumb_title = config('pms.breadcrumbs.lease.lease-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.lease.lease-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-create', $property) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<form id="lease-store" method="POST" action="{{ route('lease.store', $property->id) }}">
	        @CSRF
	            <div class="card">
	                <div class="card-header">
	                    <h5>Property/Unit</h5>
	                </div>
	                <div class="card-block">
	                    {{-- SELECT Property --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property/Unit*</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                                <select class="select2" name="unit" style="width: 100%">
	                                    <option value="#" disabled selected>Select Unit</option>
	                                    @foreach($properties as $property)
	                                        <optgroup label="{{ $property->name }}">
	                                            @foreach($units->where('property_id', $property->id) as $unit)
	                                                <option value="{{ $unit->id }}">
	                                                    {{ $unit->number }} | {{ $unit->unit_type->name }} ({{ $unit->unit_type->size }}) | {{ $unit->unit_type->lease_price_currency_sign }}
	                                                </option>
	                                            @endforeach
	                                        </optgroup>
	                                    @endforeach
	                                </select>
	                                @error('unit')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
	                            </div>
	                    </div>
	                    {{-- SELECT Tenant --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Tenant*</label>
	                            <div class="col-lg-9 col-md-9 col-sm-9">
	                                <select class="select2" name="tenant" style="width: 100%">
	                                    <option value="#" disabled selected>Select Tenant</option>
	                                    @foreach($tenants as $tenant)
	                                        <option value="{{ $tenant->id }}">{{ $tenant->user->fullnamewm }}</option>
	                                    @endforeach
	                                </select>
	                                @error('tenant')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
	                            </div>
	                            <div class="col-lg-1 col-md-1 col-sm-1">
	                                <a href="{{ route('user.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Fill-up user information sheet">
	                                    <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-user-plus fa-lg"></i>
	                                    </button>
	                                </a>
	                            </div>
	                    </div>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Agreement Details</h5>
	                </div>
	                <div class="card-block">
	                	{{-- INPUT Agreement Unique Number --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Agreement NO</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                            	<input type="text" class="form-control" name="agreement_no" value="">
                                    @error('agreement_no')
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
	                                </div>
	                            </div>
	                    </div>
	                    {{-- INPUT Term Start-End --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term Start</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="term_start">
	                            </div>
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term End</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="term_end">
	                            </div>
	                    </div>
	                    {{-- INPUT Monthly Due/Collection --}}
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Monthly Billing Date</label>
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
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Move-in Date</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                                <input type="date" class="form-control" name="first_day">
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
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Reservation</label>
	                            <div class="col-lg-9 col-md-9 col-sm-9">
	                                <select class="select2" name="reservation" style="width: 100%">
	                                    <option value="#" disabled selected>Select Payment</option>
	                                    @foreach($payments->where('payment_type_id', 2) as $payment)
                                            <option value="{{ $payment->id }}">
                                                {{ $payment->payment_type->name }} - {{ $payment->reference_no }} ({{ $payment->date_paid }}) | {{ $payment->tenant->user->fullnamewm }} ({{ $payment->amount_paid_currency_sign }})
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
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Full Payment</label>
	                            <div class="col-lg-9 col-md-9 col-sm-9">
	                                <select class="select2" name="reservation" style="width: 100%">
	                                    <option value="#" disabled selected>Select Payment</option>
	                                    @foreach($payments->where('payment_type_id', 4) as $payment)
                                            <option value="{{ $payment->id }}">
                                                {{ $payment->payment_type->name }} - {{ $payment->reference_no }} ({{ $payment->date_paid }}) | {{ $payment->tenant->user->fullnamewm }} ({{ $payment->amount_paid_currency_sign }})
                                            </option>
	                                    @endforeach
	                                </select>
	                            </div>
	                    </div>
	                </div>
	            </div>

	            {{-- SELECT TABLE Deposits --}}
	            {{-- <div class="card">
	            	<div class="card-header">
	                    <h5>Deposits</h5>
	                </div>
	                <div class="card-block">
	                	<table class="table table-sm" id="deposittable">
                             <thead>
                                 <tr>
                                    <th width="40%">Deposit Type</th>
                                    <th width="20%">Amount</th>
                                    <th width="10%">
                                    	<a href="#" id="addrow_deposit">
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
	                                    <input type="number" min="1" step="any" name="amounts[]" class="form-control" data-a-sign="{{ config('pms.currency.sign') }}">
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
	            </div> --}}

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
    @include('includes.custom-scripts.multi-deposits')
@endsection

