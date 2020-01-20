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
                                    <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">To Bill</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date From</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date To</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Previous Reading</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Present Reading</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Unit Used</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Amount</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date Updated</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($utility_bills as $bill)
                            <tr>
                                <td class="{{ config('pms.table.td.font-size') }} text-uppercase">
                                    {{ $bill->utility->type }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ FY($bill->to_bill) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($bill->start_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($bill->end_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->prev_reading }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->pres_reading }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if($bill->kw_used != null)
                                        {{ $bill->kw_used }} kWh
                                    @else
                                        {{ $bill->cubic_meter }} m^3
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ currencysign($bill->amount) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->created_at }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->updated_at }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @can('Update Utility Bill')
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>
                                    @endcan
                                     @can('Delete Utility Bill')
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