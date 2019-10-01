@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = $property->name;
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('property-show', $property) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card" style="height: 400px;overflow-y: scroll;overflow-x: hidden;">
                <div class="card-header">
                    <h4>{{ $property->name }}</h4>
                    <div class="card-header-right">
                        <a href="{{ route('property.edit', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit Property Details">
                            <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-pencil fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                        <a href="{{ route('property.destroy', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete Property">
                            <button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-trash fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="row card-block">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h6 class="sub-title">Property Details</h6>
                        <ul class="basic-list">
                            <li>
                                <h6>Address</h6>
                                <p>{{ $property->address }}</p>
                            </li>
                            <li>
                                <h6>Contact</h6>
                                <p>{{ $property->contact }}</p>
                            </li>
                            <li>
                                <h6>Floor & Units</h6>
                                <p>{{ $property->floor_total }} Floors, {{ $property->unit_total }} Units</p>
                             </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h6 class="sub-title">Other Info</h6>
                        <ul class="basic-list">
                            <li>
                                <h6>Date Finished</h6>
                                <p>{{ date('M d, Y', strtotime($property->date_finish)) }}</p>
                            </li>
                            <li>
                                <h6>Start Date for Leasing</h6>
                                <p>{{ date('M d, Y', strtotime($property->date_start_leasing)) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card table-card" style="height: 400px;overflow-y: scroll;">
                <div class="card-header">
                    <h5>Unit Types</h5>
                    <div class="card-header-right">
                        <a href="{{ route('unit-type.create', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Unit Type">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-block">
                    @if(count($unit_types) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Leasing Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unit_types as $utype)
                                        <tr>
                                            <td style="font-size: 13px;">{{ $utype->name }}
                                                <label class="badge badge-success" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Vacant">
                                                    {{ $utype->unit->where('unit_type_id', $utype->id)->where('status', 'Vacant')->count() }}
                                                </label>
                                                <label class="badge badge-default" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Occupied">
                                                    {{ $utype->unit->where('unit_type_id', $utype->id)->where('status', 'Occupied')->count() }}
                                                </label>
                                            </td>
                                            <td style="font-size: 13px;">{{ $utype->size }}</td>
                                            <td style="font-size: 13px;">{{ $utype->lease_price_peso }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                        <small>This property does not have unit types. <a href="{{ route('unit-type.create', $property->id) }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Units</h5>
                    <div class="card-header-right">
                        <a href="{{ route('unit.create', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Unit">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
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
                    @if(count($property->unit) > 0)
                        <div class="table-responsive">
                            <table id="order-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Floor</th>
                                        <th>Leasing Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($property->unit as $unit)
                                    <tr>
                                        <td style="font-size: 13px; font-weight: bold">
                                            <a href="{{ route('unit.show', [$property->slug, $unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                                {{ $unit->number }}
                                            </a>
                                        </td>
                                        <td style="font-size: 13px;">{{ $unit->unit_type->name }} ({{ $unit->unit_type->size }})</td>
                                        <td style="font-size: 13px;">{{ $unit->floor_no }}</td>
                                        <td style="font-size: 13px;">{{ $unit->unit_type->lease_price_peso }}</td>
                                        <td style="font-size: 13px;">
                                            <span class="mytooltip tooltip-effect-1">
                                                <span class="tooltip-item2">
                                                    <label class="label label-lg @if($unit->status == 'Occupied') label-default @else label-success @endif" style="color: #333333;font-size: 12px;text-transform: uppercase;font-weight: bold;">
                                                    {{ $unit->status }}
                                                    </label>
                                                </span>
                                                <span class="tooltip-content4 clearfix">
                                                    <span class="tooltip-text2">
                                                        @if($unit->status == 'Occupied')
                                                            <h6>TENANT: <a href="#" data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="View Tenant" style="color: #4099ff;">{{ $unit->rental->tenant->user->fullname }}</a></h6>
                                                            <h6>SINCE: <a href="#">{{ date('M d, Y', strtotime($unit->rental->term_start)) }}</a></h6>
                                                        @else
                                                            <h6>SINCE: <a href="#">MM/DD/YYYY</a></h6>
                                                        @endif
                                                    </span>
                                                </span>
                                            </span>
                                        </td>
                                        <td style="font-size: 13px;">
                                            <a href="{{ route('property.edit', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                                <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                            </a>
                                            <a href="{{ route('property.destroy', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                                <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Floor</th>
                                        <th>Leasing Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                        <small>This property does not have units. <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection