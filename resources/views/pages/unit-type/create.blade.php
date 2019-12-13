@extends('layouts.admindek', ['pageSlug' => 'unit-type-create'])

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.unit.icon');
        $breadcrumb_title = config('pms.breadcrumbs.unit-type.unit-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.unit-type.unit-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('unit-type-create', $property) }}
@endsection

@section('content')
<form id="create-unit-type" method="POST" action="{{ route('unit-type.store', $property->id) }}">
@CSRF
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
                            <input type="text" class="form-control" name="name" required>
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
                            <input type="text" class="form-control" name="size">
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
                            <input type="text" class="form-control" name="lease_price" required>
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