@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Leasing Form';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Lease Form</h5>
                </div>
                <div class="card-block">
                    <form id="lease-store" method="POST" action="{{ route('lease.store') }}">
                        @CSRF
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property/Unit</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <select class="select2" name="unit" style="width: 100%">
                                        <option value="#" disabled selected>Select Unit</option>
                                        @foreach($properties as $property)
                                            <optgroup label="{{ $property->name }}">
                                                @foreach($property->unit as $unit)
                                                    <option value="{{ $unit->id }}">
                                                        {{ $unit->number }} | {{ $unit->unit_type->name }} ({{ $unit->unit_type->size }}) | {{ $unit->unit_type->lease_price_peso }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                        
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Tenant</label>
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <select class="select2" name="tenant" style="width: 100%">
                                        <option value="#" disabled selected>Select Tenant</option>
                                        @foreach($tenants as $tenant)
                                            <option value="{{ $tenant->id }}">{{ $tenant->user->fullnamewm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <a href="{{ route('user.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Fill-up user information sheet">
                                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 50px;width: 50px; padding: 0;line-height: 0;padding-left: 4px;">
                                            <i class="fa fa-user-plus fa-lg"></i>
                                        </button>
                                    </a>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Leasing Price (Monthly)</label>
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <input type="number" class="form-control" name="agreed_lease_price" value="" placeholder="Override lease price here. Leave blank to keep default leasing price">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date of Contract</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="contract">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term Start</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="term_start">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Term End</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="term_end">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Monthly Billing Date</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" min=1 max=28 class="form-control" name="monthly_collection">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Move-in Date</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="date" class="form-control" name="move_in">
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

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection

