@extends('layouts.admindek', ['pageSlug' => 'user-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = config('pms.breadcrumbs.user.user-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.user.user-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('user') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Users</h5>
            <div class="card-header-right">
                @can('Create User')
                    <a href="{{ route('user.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add User">
                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-plus fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($users) > 0)
                <div>
                    <table id="order-table" class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                <th class="{{ config('pms.table.th.font-size') }}" width="50%">Full Name</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Role</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Username</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Email</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Assigned Property</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->where('is_employee', 1) as $user)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $user->user_no ?? '-' }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        <a class="f-12 f-w-700" href="{{ route('user.show', $user->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $user->fullnamewm }}
                                        </a>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @foreach($user->getRoleNames() as $role)
                                            {{ $role }} <br>
                                        @endforeach
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $user->username }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $user->email }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @if(count($access->where('user_id', $user->id)) > 0)
                                            @foreach($access->where('user_id', $user->id) as $has_access)
                                                <label class="badge badge-inverse-info">{{ $has_access->property->code }}</label> {{ $has_access->property->name }} </br>
                                            @endforeach
                                        @else
                                            No Assigned
                                        @endif

                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @can('Update User')
                                            <a href="{{ route('user.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                            </a>
                                        @endcan
                                         @can('Delete User')
                                            <a href="{{ route('user.destroy', $user->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
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
                <small>No users detected <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
