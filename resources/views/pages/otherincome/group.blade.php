@extends('layouts.admindek', ['pageSlug' => 'otherincome-group'])

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
    	<form id="oincome-store" method="POST" action="{{ route('oincome.store', [$lease->id, $lease_detail->id]) }}">
	    @CSRF
    	<div class="card">
    		<div class="card-header">
    			<h5>Add New Other Income</h5>
    		</div>
    		<div class="card-block">
                <form id="create-otherincome" method="POST" action="{{ route('oincome.store', [$lease->id, $lease_detail->id]) }}" enctype="multipart/form-data">
                    @CSRF
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
                </form>
    		</div>
    	</div>
    	</form>
        <!-- <div class="card">
            <div class="card-header">
                <h5>Attach Job Order</h5>
            </div>
            <div class="card-block">
                <form id="attach-order" method="POST" action="#" enctype="multipart/form-data">
                    @CSRF @METHOD('PATCH')
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Job Order to Attach</label>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select class="select2" name="order_attach" style="width: 100%" required>
                                    <option value="#" disabled selected>Select a Job Order</option>
                                        @foreach($orders as $order)
                                            <option value="{{ $order->id }}">
                                                {{ $order->id }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('order_attach')
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
                                <button type="submit" class="btn btn-primary btn-sm">Attach</button>
                            </div>
                    </div>
                </form>
            </div>
        </div> -->
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
	                                <th class="{{ config('pms.table.th.font-size') }}">Type</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">To Bill</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Amount</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Note</th>
	                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($otherincome->where('leasing_agreement_details_id', $lease_detail->id) as $oi)
	                            <tr>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ $oi->income_type->name }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ date('F Y', strtotime($oi->to_bill)) }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ $oi->total_amount }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
	                                	{{ $oi->note }}
	                                </td>
	                                <td class="{{ config('pms.table.td.font-size') }}">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                        </a>
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

        <!-- Display orders -->
        @include('pages.order.group')
        
	</div>
</div>
@endsection

@section('js-plugin')
	@include('includes.plugins.select-js')
	@include('includes.plugins.datatable-js')
@endsection