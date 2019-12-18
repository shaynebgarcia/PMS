@extends('layouts.admindek', ['pageSlug' => 'lease-show'])

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
                <div class="row">
                    <div class="col-2">
                        <h6>Property</h6>
                    </div>
    	        	<div class="col-10">
                        <h6>{{ $property->name }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h6>Unit</h6>
                    </div>
                    <div class="col-10">
                        <h6>{{ $lease->unit->number }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h6>Tenant(s)</h6>
                    </div>
                    <div class="col-10">
                        @foreach($lease->tenant_list as $tl)
                            <h6>{{ $tl->tenant->user->fullnamewm }}</h6>
                        @endforeach 
                    </div>
                </div>
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
	                                <th class="{{ config('pms.table.th.font-size') }}"></th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Description</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Date of Contract</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">End of Contract</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Move-in Date</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Rent</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Payments</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Deposits</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Subscriptions</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Invoice Billing Total</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Status</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Date Expired</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Date Renewed</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($lease_detail as $ld)
	                            <tr>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    <a href="{{ route('export.contract', [$ld->agreement->unit->property->id, $ld->agreement->id, $ld->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View PDF">
                                        <i class="icon feather icon-file f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $ld->description }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ MdY($ld->term_start) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ MdY($ld->term_end) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if($ld->first_day == null)
                                        NO MOVE-IN DATE
                                    @else
                                        {{ MdY($ld->first_day) }}
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ currencysign($ld->agreed_lease_price) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if(count($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [2, 6])) > 0)
                                        @foreach($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [2, 6]) as $payment)
                                            {{ $payment->payment_type->name }} ({{ currencysign($payment->amount_paid) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{-- deposits --}}
                                    @if(count($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [3, 4, 5, 7])) > 0)
                                        @foreach($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [3, 4, 5, 7]) as $payment)
                                            {{ $payment->payment_type->name }} ({{ currencysign($payment->amount_paid) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if(count($services->where('leasing_agreement_details_id', $ld->id)) >= 1 )
                                        @foreach($services->where('leasing_agreement_details_id', $ld->id) as $service)
                                            {{ $service->service_type->name }} ({{ currencysign($service->agreed_amount) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if(count($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [1])) > 0)
                                        @foreach($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [1]) as $payment)
                                            MONTHS BILLED :
                                                {{ count($billings->where('leasing_agreement_details_id', $ld->id)) }} <br>
                                            TOTAL AMOUNT:
                                                ({{ currencysign($payments->where('leasing_agreement_details_id', $ld->id)->whereIn('payment_type_id', [1])->sum('amount_paid'))}}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    <label class="label label-lg
                                        @php
                                            echo label_status($ld->status->title);
                                        @endphp" style="font-size:12px;font-weight:bold">
                                        {{ $ld->status->title }}
                                    </label>
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $ld->expired ?? '---' }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $ld->renewed ?? '---' }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @can('Update Leasing Agreements')
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>
                                    @endcan
                                     @can('Delete Leasing Agreements')
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                        </a>
                                    @endcan
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

