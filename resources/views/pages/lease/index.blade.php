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
    {{ Breadcrumbs::render('lease') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Leasing Agreements</h5>
            </div>
            <div class="card-header-right">
                <a href="" title="">
                    <button class="btn btn-sm btn-inverse waves-effect waves-light m-b-10">Create New Agreement</button>
                </a>
            </div>
        </div>
        <div class="card-block">
            
            @if(count($leases) > 0)
                <div>
                    <table id="order-table" class="table {{-- table-bordered --}} table-responsive">
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
                                <th class="f-14">Subscriptions</th>
                                {{-- <th class="f-14">Reservation Fee</th>
                                <th class="f-14">Full Payment</th>
                                <th class="f-14">Utility Deposit</th> --}}
                                <th class="f-14">Status</th>
                                <th class="f-14">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leases as $lease)
                            <tr>
                                <td class="f-12">
                                    @php
                                        if (($property_access->where('property_id', $lease->unit->property->id)->where('user_id', auth()->user()->id)->count()) > 0) {
                                            $color = 'text-c-blue';
                                            $icon = 'icon-eye';
                                            $title = 'View details';
                                        } else {
                                            $color = 'text-c-yellow';
                                            $icon = 'icon-eye-off';
                                            $title = 'You do not have permission to manage/view this agreement';
                                        }
                                    @endphp
                                    <a href="{{ route('lease.show', [$lease->unit->property->id, $lease->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ $title }}">
                                        <i class="icon feather {{ $icon }} f-w-600 f-18 m-r-15 {{ $color }}"></i>
                                    </a>
                                </td>
                                <td class="f-12 f-w-700">
                                    <a href="{{ route('property.show', $lease->unit->property->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Property Details">
                                            {{ $lease->unit->property->name }}
                                    </a>
                                </td>
                                <td class="f-12 f-w-700">
                                    <a href="{{ route('unit.show', [$lease->unit->property->slug, $lease->unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Unit Details">
                                            {{ $lease->unit->number }}
                                    </a>
                                </td>
                                <td class="f-12 f-w-700">
                                    <a href="{{ route('tenant.show', $lease->tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Tenant Details">
                                            {{ $lease->tenant->user->fullnamewm }}
                                    </a>
                                </td>
                                @php
                                    $detail = $details->where('leasing_agreement_id', $lease->id);
                                @endphp
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
                                    
                                </td>
                                <td class="f-12">
                                    
                                </td>
                                <td class="f-12">
                                    @php
                                        if ($detail->last()->status == 'Active') {
                                            $color = 'bg-success';
                                        } elseif($detail->last()->status == 'Pre-Terminated') {
                                            $color = 'bg-warning';
                                        } elseif($detail->last()->status == 'Terminated') {
                                            $color = 'bg-danger';
                                        }
                                    @endphp
                                    <label class="badge badge-lg {{ $color }}">{{ $detail->last()->status }}</label>
                                </td>
                                <td class="f-12">
                                    <div class="btn-group">
                                        <i class="icofont icofont-navigation-menu waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(4px, 17px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item waves-effect waves-light" href="#">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#">Delete</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#">Renew Agreement</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#">Separated link</a>
                                        </div>
                                    </div>
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit" id="edit-item" data-item-id="{{ $lease->id}}">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="{{ route('lease.destroy', [$lease->unit->property->id, $lease->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
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
                <small>You have no available lease <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection

