@extends('layouts.admindek')

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.unit.icon');
        $breadcrumb_title = config('pms.breadcrumbs.unit-type.unit-edit.title').$unitType->name;
        $breadcrumb_subtitle = config('pms.breadcrumbs.unit-type.unit-edit.subtitle');
    @endphp
    {{ Breadcrumbs::render('unit-type-edit', $property, $unitType) }}
@endsection

@section('content')
<form id="create-unit-type" method="POST" action="{{ route('unit-type.update', [$property->id, $unitType->id]) }}">
@CSRF @METHOD('PATCH')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Unit Type</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Type Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $unitType->name }}" required>
                            @error('name')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Size</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="size" value="{{ $unitType->size }}">
                            @error('size')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Lease Price</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="lease_price" value="{{ $unitType->lease_price }}" required>
                            @error('lease_price')
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