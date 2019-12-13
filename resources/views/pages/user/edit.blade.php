@extends('layouts.admindek', ['pageSlug' => 'user-edit'])

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = config('pms.breadcrumbs.user.user-edit.title') .$user->fullname;
        $breadcrumb_subtitle = config('pms.breadcrumbs.user.user-edit.subtitle');
    @endphp
    {{ Breadcrumbs::render('user-edit', $user) }}
@endsection

@section('content')
    <form id="edit-user" method="POST" action="{{ route('user.update', $user->id) }}">
        @CSRF @METHOD('PATCH')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Last Name*</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->lastname }}" name="lastname" required>
                                @error('lastname')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">First Name*</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->firstname }}" name="firstname" required>
                                @error('firstname')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Middle Name</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->middlename }}" name="middlename">
                                @error('middlename')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date of Birth</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" value="{{ $user->birthdate }}" name="birthdate">
                                @error('birthdate')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('Update User Credentials')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Credentials</h5>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Username*</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">@</label>
                                    </span>
                                    <input type="text" class="form-control" value="{{ $user->username }}" name="username" required>
                                </div>
                                @error('username')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email Address*</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">@</label>
                                    </span>
                                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" required>
                                </div>
                                @error('email')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Current Password</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">
                                            <i class="icofont icofont-shield"></i>
                                        </label>
                                    </span>
                                    <input type="password" class="form-control" name="password_current">
                                </div>
                                @error('password_current')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">New Password</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">
                                            <i class="icofont icofont-shield"></i>
                                        </label>
                                    </span>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                @error('password')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Confirm New Password</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">
                                            <i class="icofont icofont-shield"></i>
                                        </label>
                                    </span>
                                    <input type="password" class="form-control" name="password_confirm">
                                </div>
                                @error('password_confirm')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role and Property Assignment</h5>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Role*</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <select class="select2" name="role" style="width: 100%" required>
                                    <option value="#" disabled selected>Select Role</option>
                                    @foreach($roles as $role)
                                        <option @if($user->getRoleNames()->first() == $role->name) selected @endif value="{{ $role->name }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    @include('errors.validation', ['message' => $message])
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Assign Property*</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <select class="select2" name="properties[]" multiple="multiple" style="width: 100%">
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}" @if(count($access->where('user_id', $user->id)->where('property_id', $property->id)) > 0) selected @endif>
                                            {{ $property->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round" @cannot('Update User') disabled @endcannot>Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection