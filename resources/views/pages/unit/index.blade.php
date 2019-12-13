@extends('layouts.admindek', ['pageSlug' => 'unit-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.unit.icon');
        $breadcrumb_title = config('pms.breadcrumbs.unit.unit-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.unit.unit-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('unit', $property) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Units</h5>
                    <div class="card-header-right">
                        @can('Create Unit')
                            <a href="{{ route('unit.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Unit">
                                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-block">
                    @if(count($property->unit) > 0)
                        <div>
                            <table id="order-table" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Number (Floor)</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Type</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Electricity Meter#</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Water Meter#</th>
                                        <th class="{{ config('pms.table.th.font-size') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Default leasing price">Default</th>
                                        <th class="{{ config('pms.table.th.font-size') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Current leasing price">Current</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Status</th>
                                        <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($property->unit as $unit)
                                        @php
                                            $detail = $lease_details->where('leasing_agreement_id', $unit->leasing_agreement_id)->first();
                                            if ($detail != null) {
                                                $diff_percent = ($detail->agreed_lease_price / $unit->unit_type->lease_price) * 100 - 100;
                                                if ($detail->agreed_lease_price >= $unit->unit_type->lease_price) {
                                                    $color = 'text-c-green';
                                                    $text = '+'.round($diff_percent, 2).'%';
                                                } else {
                                                    $color = 'text-c-red';
                                                    $text = round($diff_percent, 2).'%';
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                {{ $unit->unit_no ?? '-' }}
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                                {{ $unit->number }} ({{ $unit->floor_no }})
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                {{ $unit->unit_type->name }} ({{ $unit->unit_type->size }})
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                @php
                                                    $elec = $utility_electricity->where('unit_id', $unit->id)->first();
                                                @endphp
                                                {{ $elec->no ?? '---' }}
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                @php
                                                    $water = $utility_water->where('unit_id', $unit->id)->first();
                                                @endphp
                                                {{ $water->no ?? '---' }}
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                {{ $unit->unit_type->lease_price_currency_sign }}
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                {{ $detail->agreed_lease_price_currency_sign ?? '---' }}
                                                @if($detail != null)
                                                    <br><span class="{{ $color }} f-w-700 m-l-10" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="%">{{ $text }}</span>
                                                @endif
                                                
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                <span class="mytooltip tooltip-effect-1">
                                                    <span class="tooltip-item2">
                                                        <label class="label label-lg @if($unit->leasing_agreement_id == null) label-default @else label-success @endif" style="color: #333333;font-size: 12px;text-transform: uppercase;font-weight: bold;">
                                                            @if($unit->leasing_agreement_id == null)
                                                                Vacant
                                                            @else Occupied
                                                            @endif
                                                        </label>
                                                    </span>
                                                    <span class="tooltip-content4 clearfix">
                                                        <span class="tooltip-text2">
                                                            @if($unit->leasing_agreement_id != null)
                                                                Tenant:
                                                                    @foreach($unit->leasing_agreement->tenant_list as $tl)
                                                                        <a href="{{ route('tenant.show', $tl->tenant->id) }}" class="text-primary" data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="View Tenant">
                                                                            {{ $tl->tenant->user->fullname }},
                                                                        </a>
                                                                        @if ($loop->last)
                                                                            <a href="{{ route('tenant.show', $tl->tenant->id) }}" class="text-primary" data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="View Tenant">
                                                                                {{ $tl->tenant->user->fullname }}
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                <br>
                                                                Term:
                                                                {{ MdY($detail->term_start) }} - {{ MdY($detail->term_end) }}
                                                                <br>
                                                                {{-- <a href="{{ route('lease.show', [$unit->property->id, $unit->leasing_agreement->id]) }}" class="text-primary">
                                                                    View details <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
                                                                </a> --}}
                                                            @else
                                                                Vacant Since:
                                                                <a href="#">
                                                                    ---
                                                                    {{-- {{ date('M d, Y', strtotime('2010-01-01')) }} --}}
                                                                </a>
                                                            @endif
                                                        </span>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="{{ config('pms.table.td.font-size') }}">
                                                @if($unit->leasing_agreement_id != null)
                                                {{-- <a href="{{ route('lease.show', [$unit->property->id, $unit->leasing_agreement->id]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                                    <i class="icon feather icon-eye f-w-600 f-18 m-r-15 text-c-blue"></i>
                                                </a> --}}
                                                @endif
                                                @can('Update Unit')
                                                    <a href="{{ route('unit.edit', $unit->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                        <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                                    </a>
                                                @endcan
                                                 @can('Delete Unit')
                                                    <a href="{{ route('unit.destroy', $unit->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                                        <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
    <div class="row">
        {{-- <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-block" style="overflow-y: scroll;">
                </div>
            </div>
        </div> --}}
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Unit Types</h5>
                    <div class="card-header-right">
                        @can('Create Unit Type')
                            <a href="{{ route('unit-type.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Unit Type">
                                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-block" style="overflow-y: scroll;">
                    @if(count($unit_types) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Type</th>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Occupied</th>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Vacant</th>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Size</th>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Leasing Price</th>
                                        <th class="p-2 {{ config('pms.table.th.font-size') }}">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unit_types as $utype)
                                        <tr>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                {{ $utype->name }}
                                            </td>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                {{ $utype->unit->where('unit_type_id', $utype->id)->where('leasing_agreement_id', null)->count() }}
                                            </td>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                {{ $utype->unit->where('unit_type_id', $utype->id)->where('leasing_agreement_id', !null)->count() }}
                                            </td>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                {{ $utype->size }}
                                            </td>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                {{ $utype->lease_price_currency_sign }}
                                            </td>
                                            <td class="p-2 {{ config('pms.table.td.font-size') }}">
                                                @can('Update Unit Type')
                                                    <a href="{{ route('unit-type.edit', $utype->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                        <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                                    </a>
                                                @endcan
                                                 @can('Delete Unit Type')
                                                    <a href="{{ route('unit-type.destroy', $utype->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                                        <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                        <small>This property does not have unit types. @can('Create Unit Type') <a href="{{ route('unit-type.create') }}" title="" style="color:#4099ff;font-size: 12px;">Add here.</a> @endcan </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection