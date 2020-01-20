@extends('layouts.admindek', ['pageSlug' => 'utilities-edit'])

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.utility.icon');
        $breadcrumb_title = config('pms.breadcrumbs.utility.utility-edit.title').$utility->no;
        $breadcrumb_subtitle = config('pms.breadcrumbs.utility.utility-edit.subtitle');
    @endphp
    {{ Breadcrumbs::render('utility-edit', $property, $utility) }}
@endsection

@section('content')
<form id="create-unit" method="POST" action="{{ route('utilities.store') }}">
    @CSRF
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Update Utility Details</h5>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Type</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="type" style="width: 100%">
                                    <option value="#" disabled selected>Select Type</option>
                                    @foreach($utility_types as $ut)
                                        <option value="{{ $ut->type }}" @if($ut->type == $utility->type) selected @endif>{{ $ut->type }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Meter NO</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="no" value="{{ $utility->no }}" required>
                                @error('no')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Select Unit</h5>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="unit" style="width: 100%">
                                    <option value="#" disabled selected>Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" @if($unit->id == $utility->unit_id) selected @endif>{{ $unit->number }}</option>
                                    @endforeach
                                </select>
                                @error('unit')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                    <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection
