@extends('layouts.admindek', ['pageSlug' => 'service-index'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
    {{-- @include('includes.plugins.chart-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.service.icon');
        $breadcrumb_title = config('pms.breadcrumbs.service.service-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.service.service-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('service', $property) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Service Bill</h5>
            </div>
            <div class="card-header-right">
                @can('Create Service')
                    <a href="{{ route('services.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Create New Service Agreement">
                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-plus fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
            <div class="card-block">
                @if(count($services) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive wrap">
                            <thead>
                                <tr>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Agreement</th>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Unit</th>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Tenant</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">To Bill</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Term Start</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Term End</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Amount</th>
                                    <!-- <th class="{{ config('pms.table.th.font-size') }}">Date Created</th> -->
                                    <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($services as $s)
                            <tr>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight f-w-700">
                                    {{ $s->agreement_detail->agreement_no }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                    {{ $s->agreement_detail->agreement->unit->number }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                    @foreach($s->agreement_detail->agreement->tenant_list as $tl)
                                        {{ $tl->tenant->user->lnamefname }}<br>
                                    @endforeach
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                    {{ $s->service_no }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ FY($s->to_bill) ?? '---' }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} text-uppercase">
                                    {{ $s->service_type->name }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($s->start_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($s->end_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ currencysign($s->amount) }}
                                </td>
                                <!-- <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $s->created_at }}
                                </td> -->
                                <td class="{{ config('pms.table.td.font-size') }}">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                @else
                    <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                    <small>No services/subscription bills</small>
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