@extends('layouts.admindek')

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
        <div class="card">
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
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Leasing Agreement</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <select class="select2" name="agreement" id="agreement_id" style="width: 100%">
                                <option value="#" disabled selected>Select an agreement</option>
                                    @foreach($leases as $lease)
                                        <option value="{{ $lease->details->last()->id }}">
                                            {{ $lease->details->last()->agreement_no }} | {{ $lease->unit->number }} | {{ $lease->tenant->user->fullnamewm }}
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
                            <input type="date" class="form-control" name="start_date" value="">
                        </div>
                        <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">to</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="date" class="form-control" name="end_date" value="">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Previous Reading</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="number" class="form-control" name="prev_reading" value="">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Present Reading</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="number" class="form-control" name="pres_reading" value="">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Unit Consumption</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="number" class="form-control" name="unit_used" value="">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Amount</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="number" class="form-control" name="amount" value="">
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
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Utility Bill</h5>
            </div>
            <div class="card-block">
                @if(count($utility_bills) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="f-12">Unit</th>
                                    <th class="f-12">Tenant</th>
                                    <th class="f-12">Meter NO</th>
                                    <th class="f-12">Description</th>
                                    <th class="f-12">To Bill</th>
                                    <th class="f-12">Date From</th>
                                    <th class="f-12">Date To</th>
                                    <th class="f-12">Previous Reading</th>
                                    <th class="f-12">Present Reading</th>
                                    <th class="f-12">Unit Used</th>
                                    <th class="f-12">Amount</th>
                                    <th class="f-12">Date Created</th>
                                    <th class="f-12">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($utility_bills as $bill)
                            <tr>
                                <td class="f-12">
                                    {{ $bill->agreement_detail->agreement->unit->number }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->agreement_detail->agreement->tenant->user->fullnamewm }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->utility->no }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->utility->type }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->to_bill }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->start_date }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->end_date }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->prev_reading }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->pres_reading }}
                                </td>
                                <td class="f-12">
                                    @if($bill->kw_used != null)
                                        {{ $bill->kw_used }} kWh
                                    @else
                                        {{ $bill->cubic_meter }} m^3
                                    @endif
                                </td>
                                <td class="f-12">
                                    {{ $bill->amount }}
                                </td>
                                <td class="f-12">
                                    {{ $bill->created_at }}
                                </td>
                                <td class="f-12">
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
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
                    <small>No utility bill</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.datatable-js')
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