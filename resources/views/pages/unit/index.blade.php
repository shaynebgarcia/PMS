@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Units';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('unit') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Units</h5>
            <div class="card-header-right">
            {{-- <a href="{{ route('property.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Property">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a> --}}
            </div>
        </div>
        <div class="card-block table-responsive">
            @if(count($units) > 0)
                <div>
                    <table id="order-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Number</th>
                                <th>Type</th>
                                <th>Floor</th>
                                <th>Leasing Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $unit)
                            <tr>
                                <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('property.show', $unit->property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $unit->property->name }}
                                    </a>
                                </td>
                                <td style="font-size: 13px; font-weight: bold">
                                        <a href="{{ route('unit.show', [$unit->property->slug, $unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $unit->number }}
                                        </a>
                                    </td>
                                <td style="font-size: 13px;">{{ $unit->unit_type->name }} ({{ $unit->unit_type->size }})</td>
                                <td style="font-size: 13px;">{{ $unit->floor_no }}</td>
                                <td style="font-size: 13px;">{{ $unit->unit_type->lease_price }}</td>
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
                                                        <h6>TENANT: <a href="#" data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="View Tenant" style="color: #4099ff;">{{ $unit->agreement->tenant->user->fullname }}</a></h6>
                                                        <h6>SINCE: <a href="#">{{ date('M d, Y', strtotime($unit->agreement->term_start)) }}</a></h6>
                                                    @else
                                                        <h6>SINCE: <a href="#">MM/DD/YYYY</a></h6>
                                                    @endif
                                                </span>
                                            </span>
                                        </span>
                                    </td>
                                    <td style="font-size: 13px;">
                                        <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                            <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;">
                                                <i class="fa fa-pencil fa-sm"></i>
                                            </button>
                                        </a>
                                        <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                            <button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;">
                                                <i class="fa fa-trash fa-sm"></i>
                                            </button>
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
                <small>You have no available units <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
