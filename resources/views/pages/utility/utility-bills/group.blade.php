@extends('layouts.admindek', ['pageSlug' => 'utility-bills-group'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
    {{-- @include('includes.plugins.chart-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.utility.icon');
        $breadcrumb_title = config('pms.breadcrumbs.utility.utility-bill-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.utility.utility-bill-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-utility', $property, $lease, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        {{-- <div class="card sale-card">
            <div class="card-header">
                <h5>Analytics</h5>
            </div>
            <div class="card-block">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-header">
                <h5>Utility Bill</h5>
            </div>
            <div class="card-block">
                @if(count($utility_bills) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="f-12">Description</th>
                                    <th class="f-12">To Bill</th>
                                    <th class="f-12">Date From</th>
                                    <th class="f-12">Date To</th>
                                    <th class="f-12">Previous Reading</th>
                                    <th class="f-12">Present Reading</th>
                                    <th class="f-12">Unit Used</th>
                                    <th class="f-12">Amount</th>
                                    <th class="f-12">Date Created</th>
                                    <th class="f-12">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($utility_bills as $bill)
                            <tr>
                                <td class="f-12">
                                    {{ $bill->utility->type }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->to_bill }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->start_date }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->end_date }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->prev_reading }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->pres_reading }}
                                </td>
                                <td class="f-12">
                                    @if($bill->kw_used != null)
                                        {{ $bill->kw_used }} kWh
                                    @else
                                        {{ $bill->cubic_meter }} m^3
                                    @endif
                                </td>
                                <td class="f-12">
                                    {{ $bill->amount }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->created_at }}
                                </td>
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
                    <small>No utility bill</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.datatable-js')
    {{-- @include('includes.plugins.chart-js') --}}
@endsection