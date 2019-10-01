@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Properties';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
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
            @if(count($properties) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('property.show', $property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $property->name }}
                                        </a>
                                    </td>
                                <td style="font-size: 13px;">{{ $property->address }}</td>
                                <td style="font-size: 13px;">{{ $property->contact }}</td>
                                <td style="font-size: 13px;">{{ $property->floor_total }}</td>
                                <td style="font-size: 13px;">{{ $property->unit_total }}</td>
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
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                <small>You have no available property <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
