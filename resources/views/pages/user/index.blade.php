@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Users';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('user') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Users</h5>
            <div class="card-header-right">
            <a href="{{ route('user.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add User">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($users) > 0)
                <div>
                    <table id="order-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="font-size: 13px; font-weight: bold">
                                        <a href="{{ route('user.show', $user->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $user->fullnamewm }}
                                        </a>
                                    </td>
                                    <td style="font-size: 13px; text-transform: capitalize;">
                                        {{ $user->role->title }}
                                    </td>
                                    <td style="font-size: 13px;">
                                        {{ $user->username }}
                                    </td>
                                    <td style="font-size: 13px;">
                                        {{ $user->email }}
                                    </td>
                                    <td style="font-size: 13px;">
                                        {{ $user->contact }}
                                    </td>
                                    <td style="font-size: 13px;">
                                        <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                            <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                        </a>
                                        <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
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
                <small>No users detected <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
