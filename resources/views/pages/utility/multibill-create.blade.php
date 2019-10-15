@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.formmasking-css')
    @include('includes.plugins.formpicker-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Leasing Form';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease-create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<form id="utilitybill-multi-store" method="POST" action="{{ route('utilitybill.multistore') }}">
	        @CSRF

	            {{-- SELECT TABLE Electricity Meters --}}
	            <div class="card">
	            	<div class="card-header">
	                    <h5>Electricity Bill</h5>
	                </div>
	                <div class="card-block">
	                	<table class="table table-sm" id="electricitybilltable">
                             <thead>
                                 <tr>
                                    <th width="40%">Unit/Meter No.</th>
                                    <th width="20%">Amount</th>
                                    <th width="10%">
                                    	<a href="#" id="addrow">
                                    		<button class="btn waves-effect waves-light btn-success btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-plus"></i>
	                                    	</button>
                                    	</a>
                                    </th>
                                 </tr>
                             </thead>
                             <tbody>
                               <tr>
                                <td>
                                  <select name="electricity_meters[]" class="js-example-basic-single" style="width:100%;">
                                    <option disabled selected value>Select Unit/Meter</option>
                                      @foreach ($utilities->where('utility_type_id', 1) as $electricity_meter)
                                        <option value="{{ $electricity_meter->id }}">
                                        	{{ $electricity_meter->no }} | {{ $electricity_meter->unit->number }} ({{ $electricity_meter->unit->status }})
                                        </option>
                                      @endforeach
                                  </select>
                                </td>
                                <td>
                                	<div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
	                                    </span>
	                                    <input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}">
	                                </div>
                                </td>
                                <td>
                                	<a href="#" id="btnDel">
                                		<button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-minus"></i>
	                                    </button>
                                    </a>
                                </td>
                               </tr>
                             </tbody>
                          </table>
	                </div>
	            </div>

	            {{-- SELECT TABLE Electricity Meters --}}
	            <div class="card">
	            	<div class="card-header">
	                    <h5>Water Bill</h5>
	                </div>
	                <div class="card-block">
	                	<table class="table table-sm" id="waterbilltable">
                             <thead>
                                 <tr>
                                    <th width="40%">Unit/Meter No.</th>
                                    <th width="20%">Amount</th>
                                    <th width="10%">
                                    	<a href="#" id="addrow">
                                    		<button class="btn waves-effect waves-light btn-success btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-plus"></i>
	                                    	</button>
                                    	</a>
                                    </th>
                                 </tr>
                             </thead>
                             <tbody>
                               <tr>
                                <td>
                                  <select name="water_meters[]" class="js-example-basic-single" style="width:100%;">
                                    <option disabled selected value>Select Unit/Meter</option>
                                      @foreach ($utilities->where('utility_type_id', 2) as $water_meter)
                                        <option value="{{ $water_meter->id }}">
                                        	{{ $water_meter->no }} | {{ $water_meter->unit->number }} ({{ $water_meter->unit->status }})
                                        </option>
                                      @endforeach
                                  </select>
                                </td>
                                <td>
                                	<div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
	                                    </span>
	                                    <input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}">
	                                </div>
                                </td>
                                <td>
                                	<a href="#" id="btnDel">
                                		<button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-minus"></i>
	                                    </button>
                                    </a>
                                </td>
                               </tr>
                             </tbody>
                          </table>
	                </div>
	            </div>

                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" class="btn waves-effect waves-light btn-info btn-block btn-round">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.formmasking-js')
    @include('includes.plugins.formpicker-js')
    @include('includes.custom-scripts.multi-electricitybill')
@endsection

