@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
    {{-- @include('includes.plugins.chart-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.service.icon');
        $breadcrumb_title = config('pms.breadcrumbs.service.service-bill-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.service.service-bill-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-service', $property, $lease, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Services & Subscriptions</h5>
            </div>
            <div class="card-block">
                @if(count($services) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="f-12">Description</th>
                                    <th class="f-12">Term Start</th>
                                    <th class="f-12">Term End</th>
                                    <th class="f-12">Date Created</th>
                                    <th class="f-12">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($services as $s)
                            <tr>
                                <td class="f-12">
                                    {{ $s->service_type->name }}
                                </td>
                                <td class="f-12">
                                    {{ $s->start_date }}
                                </td>
                                <td class="f-12">
                                    {{ $s->end_date }}
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