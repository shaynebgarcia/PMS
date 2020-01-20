@extends('layouts.admindek', ['pageSlug' => 'service-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.service.icon');
        $breadcrumb_title = config('pms.breadcrumbs.service.service-type-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.service.service-type-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('service-type-index') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Services/Subscriptions</h5>
            <div class="card-header-right">
              @can('Create Service Type')
                <a href="{{ route('service-type.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Service Type">
                    <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                        <i class="fa fa-plus fa-sm" style="color: white;"></i>
                    </button>
                </a>
              @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($service_types) > 0)
                <div>
                    <table id="order-table" class="table table-bordered wrap">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Subscription</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Period (mo)</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Amount</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($service_types as $st)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }} text-uppercase">
                                        {{ $st->name }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        <label class="label label-lg @if($st->is_subscription == 0) label-default @else label-success @endif" style="color: #333333;font-size: 12px;text-transform: uppercase;font-weight: bold;">
                                            @if($st->is_subscription == 0)
                                                NO
                                            @else YES
                                            @endif
                                        </label>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $st->length_month ?? 'N/A' }} @if($st->length_month != null) mo/months @endif
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $st->amount_currency_sign ?? 'N/A' }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $st->created_at }}
                                    </td>
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
                <small>You have no service/subscription types to be listed <a href="{{ route('service-type.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
