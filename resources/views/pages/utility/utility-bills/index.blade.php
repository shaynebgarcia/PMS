@extends('layouts.admindek', ['pageSlug' => 'utility-bill-index'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
    {{-- @include('includes.plugins.chart-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.utility.icon');
        $breadcrumb_title = config('pms.breadcrumbs.utility.utility-bill-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.utility.utility-bill-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('utility-bill', $property) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <!-- <div class="card">
            <form name="utility-bill-store" method="POST" action="{{ route('utility-bill.store') }}">
                @CSRF
                <div class="card-header">
                    <h5>Publish New Utility Bill</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                            <li><i class="feather icon-trash close-card"></i></li>
                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block" {{-- style="display: none;" --}}>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Leasing Agreement</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <select class="select2" name="agreement" id="agreement_id" style="width: 100%">
                                    <option value="#" disabled selected>Select an agreement</option>
                                        @foreach($leases as $lease)
                                            <option value="{{ $lease->details->last()->id }}">
                                                {{ $lease->details->last()->agreement_no }} | {{ $lease->unit->number }} | @foreach($lease->tenant_list as $tl)
                                                    {{ $tl->tenant->user->lnamefname }},
                                                    @if ($loop->last)
                                                        {{ $tl->tenant->user->lnamefname }}
                                                    @endif
                                                @endforeach
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Meter NO</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <select class="select2" name="meter" id="meter" style="width: 100%">
                                    <option value="#" disabled selected>Select an agreement first</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Period</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" name="start_date">
                            </div>
                            <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">to</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" name="end_date">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Previous Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="prev_reading">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Present Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="pres_reading">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Unit Consumption</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="unit_used">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Amount</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="amount">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Month to Bill</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="to_bill" style="width: 100%" required>
                                    <option value="#" disabled selected>Select Month</option>
                                        @foreach($period as $dt)
                                            <option value="{{ $dt->format("MY") }}">
                                                {{ $dt->format("F Y") }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('to_bill')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm">Create</button>
                            </div>
                    </div>
                </div>
            </form>
        </div> -->
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>Utility Bill</h5>
                </div>
                <div class="card-header-right">
                    @can('Create Utility Bill')
                        <a href="" id="btn-modal-create" data-toggle="modal" data-target="#modal-create">
                            <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                                <i class="fa fa-plus fa-sm" style="color: white;"></i>
                            </button>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-block">
                @if(count($utility_bills) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Agreement</th>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Unit</th>
                                    <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Tenant</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Meter NO</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">To Bill</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date From</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date To</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Previous Reading</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Present Reading</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Unit Used</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Amount</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date Updated</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($utility_bills as $bill)
                            <tr>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight f-w-700">
                                    {{ $bill->agreement_detail->agreement_no }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                    {{ $bill->agreement_detail->agreement->unit->number }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                    @foreach($bill->agreement_detail->agreement->tenant_list as $tl)
                                        {{ $tl->tenant->user->lnamefname }}<br>
                                    @endforeach
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }} text-uppercase">
                                    {{ $bill->utility->type }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->utility->no }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ FY($bill->to_bill) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($bill->start_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ dMY($bill->end_date) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->prev_reading }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->pres_reading }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @if($bill->kw_used != null)
                                        {{ $bill->kw_used }} kWh
                                    @else
                                        {{ $bill->cubic_meter }} m^3
                                    @endif
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ currencysign($bill->amount) }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->created_at }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    {{ $bill->updated_at }}
                                </td>
                                <td class="{{ config('pms.table.td.font-size') }}">
                                    @can('Update Utility Bill')
                                        @php
                                            if($bill->kw_used != null) {
                                                $unit_used = $bill->kw_used;
                                                $unit_measurement = 'kWh'; 
                                            } else {
                                                $unit_used = $bill->cubic_meter;
                                                $unit_measurement = 'm^3'; 
                                            }
                                        @endphp
                                        <a href="" id="btn-modal-edit" data-toggle="modal" data-target="#modal-edit"
                                        data-id="{{ $bill->id }}"
                                        data-description = "{{ $bill->utility->type }}"
                                        data-meter = "{{ $bill->utility->no }}"
                                        data-start_date="{{ $bill->start_date }}"
                                        data-end_date="{{ $bill->end_date }}"
                                        data-prev_reading="{{ $bill->prev_reading }}"
                                        data-pres_reading="{{ $bill->pres_reading }}"
                                        data-unit_used="{{ $unit_used }}"
                                        data-unit_measurement="{{ $unit_measurement }}"
                                        data-amount="{{ $bill->amount }}"
                                        data-to_bill="{{ $bill->to_bill }}"
                                        >
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>
                                    @endcan
                                     @can('Delete Utility Bill')
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
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
                    <small>No utility bill</small>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Publish New Utility Bill</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="utility-bill-store" method="POST" action="{{ route('utility-bill.store') }}">
            @CSRF
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Leasing Agreement</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <select class="select2" name="agreement" id="agreement_id" form="utility-bill-store" style="width: 100%">
                                    <option value="#" disabled selected>Select an agreement</option>
                                        @foreach($leases as $lease)
                                            <option value="{{ $lease->details->last()->id }}">
                                                {{ $lease->details->last()->agreement_no }} | {{ $lease->unit->number }} | @foreach($lease->tenant_list as $tl)
                                                    {{ $tl->tenant->user->lnamefname }},
                                                    @if ($loop->last)
                                                        {{ $tl->tenant->user->lnamefname }}
                                                    @endif
                                                @endforeach
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Meter NO</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <select class="select2" name="meter" id="meter" form="utility-bill-store" style="width: 100%">
                                    <option value="#" disabled selected>Select an agreement first</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Period</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" name="start_date" form="utility-bill-store">
                            </div>
                            <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">to</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" name="end_date" form="utility-bill-store">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Previous Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="prev_reading" form="utility-bill-store">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Present Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="pres_reading" form="utility-bill-store">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Unit Consumption</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="unit_used" form="utility-bill-store">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Amount</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" name="amount" form="utility-bill-store">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Month to Bill</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="select2" name="to_bill" style="width: 100%" form="utility-bill-store" required>
                                    <option value="#" disabled selected>Select Month</option>
                                        @foreach($period as $dt)
                                            <option value="{{ $dt->format("MY") }}">
                                                {{ $dt->format("F Y") }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('to_bill')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button id="store-submit" class="btn btn-primary waves-effect waves-light" form="utility-bill-store">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Utility Bill</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="utility-bill-update" name="utility-bill-update" method="POST" action="">
            @CSRF @METHOD('PATCH')
                <div class="modal-body">
                    <input type="text" name="field_id" id="field_id" value="" hidden>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Description</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" class="form-control" id="field_description" name="field_description" readonly="">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Meter NO</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" class="form-control" id="field_meter" name="field_meter" readonly="">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Month to Bill</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" class="form-control" id="field_to_bill" name="field_to_bill" readonly="">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Period</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" id="field_start_date" name="field_start_date" form="utility-bill-update">
                            </div>
                            <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">to</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="date" class="form-control" id="field_end_date" name="field_end_date" form="utility-bill-update">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Previous Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" id="field_prev_reading" name="field_prev_reading" form="utility-bill-update">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Present Reading</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" step="0.1" class="form-control" id="field_pres_reading" name="field_pres_reading" form="utility-bill-update">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Unit Consumption</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="field_unit_used" id="field_unit_used" value="" form="update-utility-bill">
                                    <span class="input-group-append">
                                        <label class="input-group-text" id="field_unit_measurement"></label>
                                    </span>
                                </div>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Amount</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
                                    </span>
                                    <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="field_amount" id="field_amount" value="" form="utility-bill-update">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="utility-bill-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.datatable-js')

    <script type="text/javascript">
        
        $(document).ready(function(){
            $(document).on('click', '#btn-modal-create', function() {
                $('#modal-create').modal('show');
                $('button#store-submit').on('click', function(){
                    $("#utility-bill-store").submit();
                });
            });
            $(document).on('click', '#btn-modal-edit', function() {
                var selected_id = $(this).data('id');
                $('#field_id').val($(this).data('id'));

                $('#field_description').val($(this).data('description'));
                $('#field_meter').val($(this).data('meter'));
                $('#field_start_date').val($(this).data('start_date'));
                $('#field_end_date').val($(this).data('end_date'));
                $('#field_prev_reading').val($(this).data('prev_reading'));
                $('#field_pres_reading').val($(this).data('pres_reading'));
                $('#field_unit_used').val($(this).data('unit_used'));
                $('#field_unit_measurement').text($(this).data('unit_measurement'));
                $('#field_amount').val($(this).data('amount'));
                $('#field_to_bill').val($(this).data('to_bill'));

                $("#utility-bill-update").attr("action", "{!!URL::to('utility-bill/"+selected_id+"')!!}");

                $('#modal-edit').modal('show');
            });

        });

    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $("#agreement_id").on('change',function () {
            populateMeter();
        });

        $("#meter").on('change',function () {
            
        });

        function populateMeter() {
            var a_id = $("#agreement_id").val();
            $.ajax({
                type:'GET',
                url:'{!!URL::to('getUtilities')!!}',
                data:{'id':a_id},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#meter').html(data);
                },
                error: function () {
                    console.log(data);
                }
            });
        }

      });
    </script>
@endsection