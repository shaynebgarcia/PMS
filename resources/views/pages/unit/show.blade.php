@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = $unit->number;
            $breadcrumb_subtitle = $unit->status; ?>
    {{ Breadcrumbs::render('unit-show', $property, $unit) }}
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card" style="height: 400px;overflow-y: scroll;overflow-x: hidden;">
            <div class="card-header">
                <h4>{{ $unit->number }}
                    <label class="label label-lg @if($unit->status == 'Occupied') label-default @else label-success @endif" style="color: #333333;font-size: 12px;text-transform: uppercase;font-weight: bold; margin-left: 5px;">
                        {{ $unit->status }}
                    </label>
                </h4>
                <div class="card-header-right">
                    <a href="{{ route('unit.edit', [$property->slug, $unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit Unit Details">
                        <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-pencil fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                    <a href="{{ route('unit.destroy', [$property->slug, $unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete Unit">
                        <button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-trash fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="row card-block">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h6 class="sub-title">Unit Details</h6>
                    <ul class="basic-list">
                        <li>
                            <h6>Type</h6>
                            <p>{{ $unit->unit_type->size }} {{ $unit->unit_type->name }}</p>
                        </li>
                        <li>
                            <h6>Floor</h6>
                            <p>{{ $unit->floor_no }}</p>
                        </li>
                        <li>
                            <h6>Leasing Price</h6>
                            <p>{{ $unit->unit_type->lease_price_peso }}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h6 class="sub-title">Other Info</h6>
                    <ul class="basic-list">
                        <li>
                            <h6>Meralco Meter</h6>
                            <p>#{{ $unit->meralco_meter_no }}</p>
                        </li>
                        <li>
                            <h6>Water Meter</h6>
                            <p>#{{ $unit->water_meter_no }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card" style="height: 400px;overflow-y: scroll;">
            <div class="card-header">
                <h5>Tenant</h5>
                <div class="card-header-right">
                    @if($unit->status == 'Vacant')
                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Tenant">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
            <div class="card-block">
                @if($unit->rental_id == null)
                    <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                    <small>Unit is unoccupied <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add tenant here.</a></small>
                @else
                <div class="row">
                    <h6 class="col-sm-4">Full Name</h6>
                    <p class="col-sm-8"><a href="#" title="" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="View Details"><button class="btn waves-effect waves-light btn-info btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-eye"></i></button> {{ $unit->rental->tenant->fullnamewm }}</a></p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Term Start</h6>
                    <p class="col-sm-8">{{ date('M d, Y', strtotime($unit->rental->term_start)) }}</p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Term End</h6>
                    <p class="col-sm-8">{{ date('M d, Y', strtotime($unit->rental->term_end)) }}</p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Contact Number</h6>
                    <p class="col-sm-8">{{ $unit->rental->tenant->contact }}</p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Email Address</h6>
                    <p class="col-sm-8">{{ $unit->rental->tenant->email }}</p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Contract</h6>
                    <p class="col-sm-8">---</p>
                </div>
                <div class="row">
                    <h6 class="col-sm-4">Billing</h6>
                    <p class="col-sm-8">---</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Renter</h5>
                <div class="card-header-right">
                    @if($unit->status == 'Vacant')
                        <a href="{{ route('unit.edit', [$property->slug, $unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Renter">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    @endif
                    {{-- <ul class="list-unstyled card-option">
                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li>
                    </ul> --}}
                </div>
            </div>
            <div class="card-block">
            </div>
        </div>
    </div>
</div>
@endsection