@extends('layouts.admindek', ['pageSlug' => 'unit-edit'])

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.unit.icon');
        $breadcrumb_title = config('pms.breadcrumbs.unit.unit-edit.title').$unit->number;
        $breadcrumb_subtitle = config('pms.breadcrumbs.unit.unit-edit.subtitle');
    @endphp
    {{ Breadcrumbs::render('unit-edit', $property, $unit) }}
@endsection

@section('content')
<form id="create-unit" method="POST" action="{{ route('unit.update', [$property->id, $unit->id]) }}">
    @CSRF @METHOD('PATCH')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Update Unit Details</h5>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Number</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="number" value="{{ $unit->number }}" required>
                                @error('number')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Floor No</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="text" class="form-control" name="floor_no" value="{{ $unit->floor_no }}" required>
                                @error('floor_no')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Type</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="type" style="width: 100%">
                                    <option value="#" disabled selected>Select Type</option>
                                    @foreach($unit_types as $utype)
                                        <option value="{{ $utype->id }}" @if($unit->unit_type_id == $utype->id ) selected @endif>{{ $utype->name }} ({{ $utype->size }})</option>
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
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Status</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="text" class="form-control" name="status" value="@if($unit->leasing_agreement_id == null)Vacant @else Occupied @endif" readonly="">
                                @error('status')
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
                    <h5>Update Unit Utilities</h5>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Electricity Meter</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="ue_type" style="width: 100%">
                                    <option value="#" disabled selected>Select Meter</option>
                                    @foreach($utilities_electricity as $ue)
                                        <option value="{{ $ue->id }}" @if($unit->utilities->where('type', 'Electricity')->first()->id == $ue->id ) selected @endif>{{ $ue->no }}</option>
                                    @endforeach
                                </select>
                                @error('ue_type')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Water Meter</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="uw_type" style="width: 100%">
                                    <option value="#" disabled selected>Select Meter</option>
                                    @foreach($utilities_water as $uw)
                                        <option value="{{ $uw->id }}" @if($unit->utilities->where('type', 'Water')->first()->id == $uw->id ) selected @endif>{{ $uw->no }}</option>
                                    @endforeach
                                </select>
                                @error('uw_type')
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
