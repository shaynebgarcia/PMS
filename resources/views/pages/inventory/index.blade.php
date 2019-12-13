@extends('layouts.admindek', ['pageSlug' => 'inventory-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.inventory.icon');
        $breadcrumb_title = config('pms.breadcrumbs.inventory.inventory-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.inventory.inventory-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('inventory') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Inventory Items</h5>
            <div class="card-header-right">
            <a href="{{ route('inventory.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Item">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($inventories) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive wrap">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">Code</th>
                                <th class="{{ config('pms.table.th.font-size') }}" width="60%">Description</th>
                                <th class="{{ config('pms.table.th.font-size') }}">QTY</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Price</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Last Updated</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $inventory->code }}
                                        </a>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $inventory->description }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $inventory->qty }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $inventory->price_currency_sign }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $inventory->created_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $inventory->updated_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.add-stock.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.add-stock.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.add-stock.color') }}"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.reduce-stock.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.reduce-stock.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.reduce-stock.color') }}"></i>
                                        </a>
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
                <small>You have no available inventory items <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
