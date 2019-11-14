@extends('layouts.admindek')

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.property.icon');
        $breadcrumb_title = config('pms.breadcrumbs.property.property-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.property.property-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('property-create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Property</h5>
                </div>
                <div class="card-block">
                    <form id="create-property" method="POST" action="{{ route('property.store') }}">
                        @CSRF
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property Name</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Address</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <textarea class="form-control max-textarea" maxlength="255" rows="4" name="address"></textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="text" class="form-control" name="contact">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Floor Count</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" class="form-control" name="floor_total" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Count</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" class="form-control" name="unit_total" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date Finished</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="date_finish">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Starting Date for Leasing</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="date_start_leasing">
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                <button type="submit" class="btn waves-effect waves-light btn-info btn-round">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection