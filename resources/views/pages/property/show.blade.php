@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.property.icon');
        $breadcrumb_title = $property->name;
        $breadcrumb_subtitle = config('pms.breadcrumbs.property.property-show.subtitle');
    @endphp
    {{ Breadcrumbs::render('property-show', $property) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $property->name }}</h4>
                    <div class="card-header-right">
                        <a href="{{ route('property.edit', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit Property Details">
                            <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-pencil fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                        <a href="{{ route('property.destroy', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete Property">
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
        {{-- <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card table-card" style="height: 400px;">
                <div class="card-header">
                    <h5>Unit Types</h5>
                    <div class="card-header-right">
                        <a href="{{ route('unit-type.create', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Unit Type">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-block" style="overflow-y: scroll;">
                    @if(count($unit_types) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th class="p-2 f-12">Type</th>
                                        <th class="p-2 f-12">Size</th>
                                        <th class="p-2 f-12">Leasing Price</th>
                                        <th class="p-2 f-12">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unit_types as $utype)
                                        <tr>
                                            <td class="p-2 f-12">{{ $utype->name }}
                                                <label class="badge badge-success" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Vacant">
                                                    {{ $utype->unit->where('unit_type_id', $utype->id)->where('leasing_agreement_id', null)->count() }}
                                                </label>
                                                <label class="badge badge-default" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Occupied">
                                                    {{ $utype->unit->where('unit_type_id', $utype->id)->where('leasing_agreement_id', !null)->count() }}
                                                </label>
                                            </td>
                                            <td class="p-2 f-12">{{ $utype->size }}</td>
                                            <td class="p-2 f-12">{{ $utype->lease_price_currency_sign }}</td>
                                            <td class="p-2 f-12">
                                                <a href="{{ route('unit-type.edit', [$property->code, $utype->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                </a>
                                                <a href="{{ route('unit-type.destroy', [$property->code, $utype->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                                    <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                        <small>This property does not have unit types. <a href="{{ route('unit-type.create', $property->code) }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
                    @endif
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection