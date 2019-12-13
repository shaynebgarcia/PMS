@extends('layouts.admindek', ['pageSlug' => 'property-edit'])

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.property.icon');
        $breadcrumb_title = config('pms.breadcrumbs.property.property-edit.title') .$property->name;
        $breadcrumb_subtitle = config('pms.breadcrumbs.property.property-edit.subtitle');
    @endphp
    {{ Breadcrumbs::render('property-edit', $property) }}
@endsection

@section('content')
<form id="update-property" method="POST" action="{{ route('property.update', $property->code) }}">
    @CSRF @METHOD('PATCH')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Update Property</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $property->name }}" required>
                            @error('name')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Address</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <textarea class="form-control max-textarea" maxlength="255" rows="4" name="address">{{ $property->address }}</textarea>
                            @error('address')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact Number</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="contact" value="{{ $property->contact }}">
                            @error('contact')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Floor Count</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="number" class="form-control" name="floor_total" value="{{ $property->floor_total }}" required>
                            @error('floor_total')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Count</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="number" class="form-control" name="unit_total" value="{{ $property->unit_total }}" required>
                            @error('unit_total')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date Finished</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="date" class="form-control" name="date_finish" value="{{ $property->date_finish }}">
                            @error('date_finish')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Starting Date for Leasing</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="date" class="form-control" name="date_start_leasing" value="{{ $property->date_start_leasing }}">
                            @error('date_start_leasing')
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
                <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round" @cannot('Update Property') disabled @endcannot>Submit</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection