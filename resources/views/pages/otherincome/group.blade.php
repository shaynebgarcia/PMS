@extends('layouts.admindek')

@section('css-plugin')
	@include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.oincome.icon');
        $breadcrumb_title = config('pms.breadcrumbs.oincome.oincome-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.oincome.oincome-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-oincome', $property, $lease, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    	<form id="oincome-store" method="POST" action="{{ route('oincome.store', [$property->id, $lease->id, $lease_detail->id]) }}">
	    @CSRF
    	<div class="card">
    		<div class="card-header">
    			Add new Other Income
    		</div>
    		<div class="card-block">
    			<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Income Type</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        	<select class="select2" name="oincome_type" style="width: 100%" required>
                                <option value="#" disabled selected>Select Income Type</option>
									@foreach($otherincome_types as $oit)
	                                    <option value="{{ $oit->id }}">
	                                        {{ $oit->name }} ({{ $oit->amount_currency_sign }})
	                                    </option>
									@endforeach
                            </select>
                            @error('oincome_type')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                        	<input type="text" class="form-control" name="amount" value="" placeholder="Override amount here">
	                            @error('amount')
	                                <span class="messages">
	                                    <p class="text-danger error">{{ $message }}</p>
	                                </span>
	                            @enderror
                        </div>
            	</div>
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Note</label>
                        <div class="col-lg-7 col-md-7 col-sm-7">
                        	<textarea rows="3" cols="5" class="form-control" name="note" value=""></textarea>
                            @error('note')
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
            	</div>
            	<div class="form-group row">
            		<label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Month to Bill</label>
                        <div class="col-lg-7 col-md-7 col-sm-7">
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
                        <div class="col-lg-2 col-md-2 col-sm-2">
                        	<button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
            	</div>
    		</div>
    	</div>
    	</form>

    	<div class="card">
    		<div class="card-header">
                <h5>Other Income</h5>
            </div>
            <div class="card-block">
	            @if(count($otherincome->where('leasing_agreement_details_id', $lease_detail->id)) > 0)
	                <div>
	                    <table id="order-table" class="table table-bordered table-responsive">
	                        <thead>
	                            <tr>
	                                <th class="f-12">Type</th>
	                                <th class="f-12">To Bill</th>
	                                <th class="f-12">Amount</th>
	                                <th class="f-12">Note</th>
	                                <th class="f-12">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($otherincome->where('leasing_agreement_details_id', $lease_detail->id) as $oi)
	                            <tr>
	                                <td class="f-12">
	                                	{{ $oi->other_income_type_id }}
	                                </td>
	                                <td class="f-12">
	                                	{{ date('F Y', strtotime($oi->to_bill)) }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $oi->amount }}
	                                </td>
	                                <td class="f-12">
	                                	{{ $oi->note }}
	                                </td>
	                                <td class="f-12">
	                                </td>
	                            </tr>
	                        @endforeach
	                        </tbody>
	                    </table>
	                </div>
	            @else
	                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
	                <small>No other income to bill</small>
	            @endif
            </div>
    	</div>
	</div>
</div>
@endsection

@section('js-plugin')
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-js')
@endsection