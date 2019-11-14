@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = config('pms.breadcrumbs.user.user-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.user.user-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('user-create') }}
@endsection

@section('content')
    <form id="create-user" method="POST" action="{{ route('user.store') }}">
        @CSRF
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
                                <input type="text" class="form-control" name="lastname" required>
                                @error('lastname')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">First Name*</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="firstname" required>
                                @error('firstname')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Middle Name</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="middlename">
                                @error('middlename')
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
                                    <input type="text" class="form-control" name="username" required>
                                    @error('username')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email Address*</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">@</label>
                                    </span>
                                    <input type="email" class="form-control" name="email" required>
                                    @error('email')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Password*</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">
                                            <i class="icofont icofont-shield"></i>
                                        </label>
                                    </span>
                                    <input type="password" class="form-control" name="password" required>
                                    @error('password')
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
        </div>
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
                                        <option value="{{ $role->id }}">
                                            {{ $role->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Assign Property*</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <select class="select2" name="properties[]" multiple="multiple" style="width: 100%">
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}">
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
                <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection