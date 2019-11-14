@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.lease.icon');
        $breadcrumb_title = config('pms.breadcrumbs.lease.lease-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.lease.lease-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease', $property) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Leasing Agreements</h5>
            </div>
            <div class="card-header-right">
                <a href="{{ route('lease.create', $property->id) }}" title="">
                    <button class="btn btn-sm btn-inverse waves-effect waves-light m-b-10">Create New Agreement</button>
                </a>
            </div>
        </div>
        <div class="card-block">       
            @if(count($leases) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="f-14"></th>
                                <th class="f-14">Property</th>
                                <th class="f-14">Unit</th>
                                <th class="f-14">Tenant</th>
                                <th class="f-14" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Most recent date of contract">Date of Contract</th>
                                <th class="f-14">First Date</th>
                                <th class="f-14">Rent</th>
                                <th class="f-14">Payments</th>
                                <th class="f-14">Deposits</th>
                                <th class="f-14">Subscriptions</th>
                                <th class="f-14">Utility Meter</th>
                                <th class="f-14">Status</th>
                                <th class="f-14">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leases as $lease)
                            @php
                                $detail = $details->where('leasing_agreement_id', $lease->id);
                            @endphp
                            <tr>
                                <td class="f-12">
                                    <a href="{{ route('lease.show', [$lease->unit->property->id, $lease->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View History">
                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                    <a href="{{ route('export.contract', [$lease->unit->property->id, $lease->id, $detail->last()->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View PDF">
                                        <i class="icon feather icon-file f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                    {{-- <a href="{{ route('billing.group.lease', [$lease->unit->property->id, $lease->id, $detail->last()->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ $title }}">
                                        <i class="icon feather {{ $icon }} f-w-600 f-18 m-r-15 {{ $color }}"></i>
                                    </a> --}}
                                </td>
                                <td class="f-12 f-w-700">
                                    <a href="{{ route('property.show', $lease->unit->property->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Property Details">
                                            {{ $lease->unit->property->name }}
                                    </a>
                                </td>
                                <td class="f-12 f-w-700">
                                    {{ $lease->unit->number }}
                                </td>
                                <td class="f-12 f-w-700">
                                    <a href="{{ route('tenant.show', $lease->tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Tenant Details">
                                            {{ $lease->tenant->user->fullnamewm }}
                                    </a>
                                </td>
                                <td class="f-12">
                                    {{ date('M d, Y', strtotime($detail->last()->term_start)) }}
                                    <label class="badge badge-primary m-l-5" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Times of renewal">
                                        {{ count($detail) }}
                                    </label>
                                </td>
                                <td class="f-12">
                                    {{ date('M d, Y', strtotime($detail->last()->first_day)) }}
                                </td>
                                <td class="f-12">
                                    {{ $detail->last()->agreed_lease_price_currency_sign }}
                                </td>
                                <td class="f-12">
                                    @foreach($payments->where('leasing_agreement_details_id', $detail->last()->id)->whereNotIn('payment_type_id', [1]) as $payment)
                                        {{ $payment->payment_type->name }} ({{ $payment->amount_paid_currency_sign }}) <br>
                                    @endforeach
                                </td>
                                <td class="f-12">
                                    {{-- deposits --}}
                                    NONE
                                </td>
                                <td class="f-12">
                                    @if(count($services->where('leasing_agreement_details_id', $detail->last()->id)) >= 1 )
                                        @foreach($services->where('leasing_agreement_details_id', $detail->last()->id) as $service)
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
                                        if ($detail->last()->status == 'Active') {
                                            $color = 'label-success';
                                        } elseif($detail->last()->status == 'Pre-Terminated') {
                                            $color = 'label-warning';
                                        } elseif($detail->last()->status == 'Terminated') {
                                            $color = 'label-danger';
                                        }
                                    @endphp
                                    <label class="label label-lg {{ $color }}" style="font-size:12px;font-weight:bold">{{ $detail->last()->status }}</label>
                                </td>
                                <td class="f-12">
                                     <a id="actionToggle" lease-property_id="{{ $lease->unit->property->id }}" lease-id="{{ $lease->id }}" lease-detail-id="{{ $detail->last()->id }}" data-toggle="modal" data-target="#action">
                                        <i class="icon feather icon-more-vertical f-w-600 f-16 m-r-15 text-c-gray" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View More Actions"></i>
                                     </a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit" id="edit-item" data-item-id="{{ $lease->id}}">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="{{ route('lease.destroy', [$lease->unit->property->id, $lease->id, $detail->last()->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
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
                <small>You have no available lease <a href="{{ route('lease.create', $property->id) }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @if(count($leases) > 0)
        <div id="action" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Action</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body version" style="padding: 0;">
                    <ul class="nav navigation">
                        <li class="navigation-header" style="border-top: 0;">
                            <i class="icon-history pull-right"></i> <b>Payment</b>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Attach Payment</a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Payment History</a><br>
                        </li>
                        <li class="navigation-header" style="border-top: 0;">
                            <i class="icon-history pull-right"></i> <b>Contract</b>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Generate Contract (PDF)<span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Renew Contract <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Contract History</a><br>
                        </li>
                        <li class="navigation-header" style="border-top: 0;">
                            <i class="icon-history pull-right"></i> <b>Billing</b></a>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="{{ route('billing.group.lease', [$lease->unit->property->id, $lease->id, $detail->last()->id]) }}">Billing</a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Electricity Bill <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Water Bill <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="{{ route('oincome.group.lease', [$lease->unit->property->id, $lease->id, $detail->last()->id]) }}">Other Income to Bill</a><br>
                        </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    @endif
    @include('includes.plugins.datatable-js')
@endsection

