@extends('layouts.admindek', ['pageSlug' => 'utilities-index'])

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
            <div class="card-header-left">
                <h5>Utilities</h5>
            </div>
            <div class="card-header-right">
                @can('Create Utility')
                    <a href="{{ route('utilities.create') }}" title="">
                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-plus fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($utilities) > 0)
                <div>
                    <table id="order-table" class="table table-bordered wrap">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Meter NO</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Unit</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($utilities as $utility)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $utility->type }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $utility->no }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $utility->unit->number ?? '---' }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $utility->created_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @can('Update Utility')
                                            <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                            </a>
                                        @endcan
                                         @can('Delete Utility')
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
                <small>You have no utilities to be listed <a href="{{ route('utilities.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
