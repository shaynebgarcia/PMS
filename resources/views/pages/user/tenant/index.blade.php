@extends('layouts.admindek', ['pageSlug' => 'tenant-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = config('pms.breadcrumbs.user.tenant-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.user.tenant-show.subtitle');
    @endphp
    {{ Breadcrumbs::render('tenant', $property) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tenants</h5>
            <div class="card-header-right">
                @can('Create Tenant')
                    <a href="{{ route('tenant.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Tenant">
                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-plus fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($tenants) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Full Name</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Role</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Contact</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Status</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $tenant->tenant_no ?? '-' }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        <a class="f-12 f-w-700" href="{{ route('tenant.show', $tenant->user->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $tenant->user->fullnamewm }}
                                        </a>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @foreach($tenant->user->getRoleNames() as $role)
                                            {{ $role }} <br>
                                        @endforeach
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $tenant->contact }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{-- {{ $tenant->user->role->title }} --}}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @can('Update Tenant')
                                            <a href="{{ route('tenant.edit', $tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                            </a>
                                        @endcan
                                         @can('Delete Tenant')
                                            <a href="{{ route('tenant.destroy', $tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
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
                <small>No tenants found <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection