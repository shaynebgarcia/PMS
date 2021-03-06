@extends('layouts.admindek', ['pageSlug' => 'lease-index'])

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
                @can('Create Leasing Agreements')
                    <a href="{{ route('lease.create') }}" title="">
                        <button class="btn btn-sm btn-inverse waves-effect waves-light m-b-10">Create New Agreement</button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-block">       
            @if(count($leases) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}"></th>
                                <th class="{{ config('pms.table.th.font-size') }}">ID</th>
                                {{-- <th class="{{ config('pms.table.th.font-size') }}">Property</th> --}}
                                <th class="{{ config('pms.table.th.font-size') }}">Unit</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Tenant</th>
                                <th class="{{ config('pms.table.th.font-size') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Most recent date of contract">Date of Contract</th>
                                <th class="{{ config('pms.table.th.font-size') }}">End of Contract</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Move-in Date</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Rent</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Payments</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Deposits</th>
                                <!-- <th class="{{ config('pms.table.th.font-size') }}">Subscriptions</th> -->
                                <th class="{{ config('pms.table.th.font-size') }}">Utility Meter</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Status</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leases as $lease)
                            @php
                                $detail = $details->where('leasing_agreement_id', $lease->id);
                            @endphp
                            <tr
                            {{-- @if($payment->leasing_agreement_details_id == null)
                                style="background-color: #f9e596"
                            @endif --}}
                            >
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    <a id="actionTOGGLE" data-property="{{ $lease->unit->property->code }}" data-lease="{{ $lease->id }}" data-detail="{{ $detail->last()->id }}" data-toggle="modal" data-target="#action">
                                        <i class="icon feather icon-grid f-16 f-w-600 f-16 m-r-15 text-c-gray" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View More Actions"></i>
                                    </a>
                                    {{-- <a href="{{ route('lease.show', [$lease->unit->property->code, $lease->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View History">
                                        <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                    <a href="{{ route('export.contract', [$lease->unit->property->code, $lease->id, $detail->last()->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View PDF">
                                        <i class="icon feather icon-file f-w-600 f-18 m-r-15 text-c-blue"></i>
                                    </a>
                                    <a href="{{ route('billing.group.lease', [$lease->unit->property->code, $lease->id, $detail->last()->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Billing">
                                        <i class="icon feather icon-file f-w-600 f-18 m-r-15 text-c-green"></i>
                                    </a> --}}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                    {{ $detail->last()->agreement_no }}
                                </td>
                                {{-- <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                    <a href="{{ route('property.show', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Property Details">
                                            {{ $lease->unit->property->name }}
                                    </a>
                                </td> --}}
                                <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                    {{ $lease->unit->number }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                    @foreach($lease->tenant_list as $tl)
                                        <a href="{{ route('tenant.show', $tl->tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Tenant Details">
                                            {{ $tl->tenant->user->fullnamewm }} <br>
                                        </a>
                                    @endforeach
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ MdY($detail->last()->term_start) }}
                                    <label class="badge badge-primary m-l-5" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Times of renewal">
                                        {{ count($detail) }}
                                    </label>
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ MdY($detail->last()->term_end) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if($detail->last()->first_day == null)
                                        NO MOVE-IN DATE
                                    @else
                                        {{ MdY($detail->last()->first_day) }}
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ currencysign($detail->last()->agreed_lease_price) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if(count($payments->where('leasing_agreement_details_id', $detail->last()->id)->whereIn('payment_type_id', [2, 6])) > 0)
                                        @foreach($payments->where('leasing_agreement_details_id', $detail->last()->id)->whereIn('payment_type_id', [2, 6]) as $payment)
                                            {{ $payment->payment_type->name }} ({{ currencysign($payment->amount_paid) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{-- deposits --}}
                                    @if(count($payments->where('leasing_agreement_details_id', $detail->last()->id)->whereIn('payment_type_id', [3, 4, 5, 7])) > 0)
                                        @foreach($payments->where('leasing_agreement_details_id', $detail->last()->id)->whereIn('payment_type_id', [3, 4, 5, 7]) as $payment)
                                            {{ $payment->payment_type->name }} ({{ currencysign($payment->amount_paid) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td>
                                <<!-- td class="{{ config('pms.table.td.font-size') }}">
                                    @if(count($services->where('leasing_agreement_details_id', $detail->last()->id)) >= 1 )
                                        @foreach($services->where('leasing_agreement_details_id', $detail->last()->id) as $service)
                                            {{ $service->service_type->name }} ({{ currencysign($service->amount) }}) <br>
                                        @endforeach
                                    @else
                                        NONE
                                    @endif
                                </td> -->
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @foreach($utilities->where('unit_id', $lease->unit->id) as $utility)
                                        {{ $utility->type }} Meter #{{ $utility->no }} <br>
                                    @endforeach
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    <label class="label label-lg
                                        @php
                                            echo label_status($detail->last()->status->title);
                                        @endphp" style="font-size:12px;font-weight:bold">
                                        {{ $detail->last()->status->title }}
                                    </label>
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
                <small>You have no available lease <a href="{{ route('lease.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
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
                            <i class="icon-history pull-right"></i> <b class="text-uppercase">Contract</b>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-lease-export" href="#">Generate Contract (.PDF)<span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-lease-renew" href="#">Renew Contract <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-lease-renew" href="#">Termination <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-lease-show" href="#">Contract History</a><br>
                        </li>
                        <li class="navigation-header" style="border-top: 0;">
                            <i class="icon-history pull-right"></i> <b class="text-uppercase">Billing</b></a>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-billing" href="#">Monthly Billing Invoice</a><br>
                        </li>
                        {{-- <li class="waves-effect waves-light">
                            <a href="">Electricity Bill <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="">Water Bill <span class="text-muted text-regular pull-right">Jan 2019</span></a><br>
                        </li> --}}
                        <li class="waves-effect waves-light">
                            <a id="href-utility" href="#">Utility</a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-service" href="#">Services</a><br>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-oincome" href="#">Job Orders & Other Income</a><br>
                        </li>
                        <li class="navigation-header" style="border-top: 0;">
                            <i class="icon-history pull-right"></i> <b class="text-uppercase">Payment</b>
                        </li>
                        <li class="waves-effect waves-light">
                            <a id="href-payments" href="#">Payments & Deposits</a><br>
                        </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        $(document).on('click', '#actionTOGGLE', function() {
            propertycode = $(this).data('property');
            leaseid = $(this).data('lease');
            leasedid = $(this).data('detail');

            console.log(propertycode);
            console.log(leaseid);
            console.log(leasedid);

            $('#href-lease-show').attr("href", "/lease/"+leaseid);
            $('#href-lease-export').attr("href", "/lease/"+leaseid+"/"+leasedid+"/export");
            $('#href-lease-renew').attr("href", "/lease/"+leaseid+"/renew");
            $('#href-lease-termination').attr("href", "/lease/"+leaseid+"/"+leasedid+"/termination");
            $('#href-billing').attr("href", "/lease/"+leaseid+"/"+leasedid+"/billing");
            $('#href-oincome').attr("href", "/lease/"+leaseid+"/"+leasedid+"/other-income");
            $('#href-payments').attr("href", "/lease/"+leaseid+"/"+leasedid+"/payment");
            $('#href-utility').attr("href", "/lease/"+leaseid+"/"+leasedid+"/utility-bill");
            $('#href-service').attr("href", "/lease/"+leaseid+"/"+leasedid+"/service-bill");
        });
    </script>
    @include('includes.plugins.datatable-js')
@endsection

