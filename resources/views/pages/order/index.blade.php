@extends('layouts.admindek', ['pageSlug' => 'order-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.order.icon');
        $breadcrumb_title = config('pms.breadcrumbs.order.order-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.order.order-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('order') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Job Orders</h5>
            <div class="card-header-right">
            <a href="{{ route('orders.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Create Job Order">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($orders) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive wrap">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Description</th>
                                <th>QTY</th>
                                <th>Price</th>
                                <th>Date Created</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td style="font-size: 13px; font-weight: bold">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                                {{ $order->order_no }}
                                            </a>
                                    </td>
                                    <td class="f-12">
                                    </td>
                                    <td class="f-12">
                                    </td>
                                    <td class="f-12">
                                    </td>
                                    <td class="f-12">{{ $order->created_at }}</td>
                                    <td class="f-12">{{ $order->updated_at }}</td>
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
                <small>You have no available orders <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
