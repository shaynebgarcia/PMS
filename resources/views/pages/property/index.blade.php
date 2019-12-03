@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.property.icon');
        $breadcrumb_title = config('pms.breadcrumbs.property.property-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.property.property-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('property') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Properties</h5>
            <div class="card-header-right">
            <a href="{{ route('property.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Property">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @php
                // echo print_r($values);
            @endphp
            @if(count($properties) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Floors</th>
                                <th>Units</th>
                                <th>Occupied/Vacant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                                <tr>
                                    <td class="f-w-700" style="font-size: 13px;">
                                        @php
                                            if (($property_access->where('property_id', $property->id)->where('user_id', auth()->user()->id)->count()) > 0) {
                                                $color = 'btn-success';
                                                $icon = 'fa-check';
                                                $title = 'You can manage this property';
                                                $check_access = true;
                                            } else {
                                                $color = 'btn-danger';
                                                $icon = 'fa-ban';
                                                $title = 'You do not have access to manage this property';
                                                $check_access = false;
                                            }
                                        @endphp
                                        <button class="btn waves-effect waves-light {{ $color }} btn-sm btn-icon" style="height: 25px;width: 25px; padding: 0;line-height: 0;padding-left: 4px;" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ $title }}">
                                            <i class="fa {{ $icon }} fa-sm" style="color: white;"></i>
                                        </button>
                                        <a href="{{ route('property.show', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $property->name }}
                                        </a>
                                    </td>
                                    <td class="f-w-700 text-uppercase" style="font-size: 13px;">
                                        {{ $property->code }}
                                    </td>
                                    <td style="font-size: 13px;">{{ $property->address }}</td>
                                    <td style="font-size: 13px;">{{ $property->contact }}</td>
                                    <td style="font-size: 13px;">{{ $property->floor_total }}</td>
                                    <td style="font-size: 13px;">{{ $property->unit_total }}</td>
                                    <td style="font-size: 13px;">{{ $property->unit->where('leasing_agreement_id', !null)->count() }}/{{ $property->unit->where('leasing_agreement_id', null)->count() }}</td>
                                    <td style="font-size: 13px;">
                                        <a href="{{ route('property.edit', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                            <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                        </a>
                                        <a href="{{ route('property.destroy', $property->code) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
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
                <small>You have no available property <a href="{{ route('property.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
