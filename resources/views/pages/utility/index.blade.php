@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.utility.icon');
        $breadcrumb_title = config('pms.breadcrumbs.utility.utility-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.utility.utility-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('utility', $property) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Utilities</h5>
            <div class="card-header-right">
            <a href="{{ route('utilities.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Utility">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($utilities) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive wrap">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Meter NO</th>
                                <th>Unit</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($utilities as $utility)
                                <tr>
                                    <td class="f-12">
                                        {{ $utility->type }}
                                    </td>
                                    <td class="f-12">
                                        {{ $utility->no }}
                                    </td>
                                    <td class="f-12">
                                        {{ $utility->unit->number ?? '---' }}
                                    </td>
                                    <td class="f-12">
                                        {{ $utility->created_at }}
                                    </td>
                                    <td class="f-12">
                                    <a href="{{ route('utilities.edit', $utility->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
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
                <small>You have no utilities to be listed <a href="{{ route('utilities.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
