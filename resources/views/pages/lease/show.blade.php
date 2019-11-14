@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.widget-css')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.lease.icon');
        $breadcrumb_title = config('pms.breadcrumbs.lease.lease-show.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.lease.lease-show.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-show', $property, $lease) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	<div class="card">
			<div class="card-header">
	            <h5>Leasing Association</h5>
	        </div>
	        <div class="card-block">
	        	<h6>Property: {{ $property->name }}</h6>
	        	<h6>Unit: {{ $lease->unit->number }}</h6>
	        	<h6>Tenant: {{ $lease->tenant->user->fullnamewm }}</h6>
	        </div>
	    </div>
		<div class="card">
			<div class="card-header">
	            <h5>Leasing Agreements History</h5>
	        </div>
	        <div class="card-block">
	            @if(count($lease_detail) > 0)
	                <div>
	                    <table id="order-table" class="table table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                                <th class="f-14"></th>
	                                <th class="f-14">Description</th>
	                                <th class="f-14" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Most recent date of contract">Date of Contract</th>
	                                <th class="f-14">First Date</th>
	                                <th class="f-14">Rent</th>
	                                <th class="f-14">Payments</th>
	                                <th class="f-14">Deposits</th>
	                                <th class="f-14">Subscriptions</th>
	                                <th class="f-14">Utility Meter</th>
	                                <th class="f-14">Status</th>
	                                <th class="f-14">Date Expired</th>
	                                <th class="f-14">Date Renewed</th>
	                                <th class="f-14">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($lease_detail as $ld)
	                            <tr>
                                <td class="f-12">
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View PDF">
                                        <i class="icon feather icon-file f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                </td>
                                <td class="f-12">
                                    {{ $ld->description }}
                                </td>
                                <td class="f-12">
                                    {{ date('M d, Y', strtotime($ld->term_start)) }}
                                </td>
                                <td class="f-12">
                                    {{ date('M d, Y', strtotime($ld->first_day)) }}
                                </td>
                                <td class="f-12">
                                    {{ $ld->agreed_lease_price_currency_sign }}
                                </td>
                                <td class="f-12">
                                    @foreach($payments->where('leasing_agreement_details_id', $ld->id)->whereNotIn('payment_type_id', [1]) as $payment)
                                        {{ $payment->payment_type->name }} ({{ $payment->amount_paid_currency_sign }}) <br>
                                    @endforeach
                                </td>
                                <td class="f-12">
                                    {{-- deposits --}}
                                    NONE
                                </td>
                                <td class="f-12">
                                    @if(count($services->where('leasing_agreement_details_id', $ld->id)) >= 1 )
                                        @foreach($services->where('leasing_agreement_details_id', $ld->id) as $service)
                                            {{ $service->service_type->name }} ({{ $service->agreed_amount_currency_sign }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="f-12">
                                    @foreach($utilities->where('unit_id', $lease->unit->id) as $utility)
                                        {{ $utility->type }} Meter #{{ $utility->no }} <br>
                                    @endforeach
                                </td>
                                <td class="f-12">
                                    @php
                                        if ($ld->status == 'Active') {
                                            $color = 'label-success';
                                        } elseif($ld->status == 'Pre-Terminated' || 'Expiring') {
                                            $color = 'label-warning';
                                        } elseif($ld->status == 'Terminated' || 'Expired') {
                                            $color = 'label-danger';
                                        }
                                    @endphp
                                    <label class="label label-lg {{ $color }}" style="font-size:12px;font-weight:bold">{{ $ld->status }}</label>
                                </td>
                                <td class="f-12">
                                </td>
                                <td class="f-12">
                                </td>
                                <td class="f-12">
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit" id="edit-item" data-item-id="{{ $lease->id}}">
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
	                <small>No history/details has been found</small>
	            @endif
	        </div>
		</div>
	</div>
</div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection

