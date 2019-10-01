@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = $tenant->user->fullnamewm;
            $breadcrumb_subtitle = ucfirst($tenant->user->role->title); ?>
    {{ Breadcrumbs::render('user-show', $tenant->user) }}
@endsection

@section('content')
<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div class="row">
			<div class="col-lg-12 text-center p-b-25">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" style="padding: 0.5rem 1.2rem;">Units</button>
					<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"style="padding: 0.5rem 1.2rem;">Payment History</button>
					<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"style="padding: 0.5rem 1.2rem;">Billing History</button>
				</div>
			</div>
		</div>
		<div id="navigation">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header borderless">
							<h5>{{ $tenant->user->fullnamewm }}</h5>
							<div class="card-header-right">
								<div class="btn-group">
									<i class="icofont icofont-navigation-menu waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
									<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(2px, 46px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item waves-effect waves-light" href="#">Edit Tenant Details</a>
									<a class="dropdown-item waves-effect waves-light" href="#">Another action</a>
									<a class="dropdown-item waves-effect waves-light" href="#">Something else</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item waves-effect waves-light" href="#">Separated link</a>
									</div>
								</div>
							
							</div>
						</div>
						<div class="card-block">
							@if ($tenant->user->contact == !null)
								<div class="row mt-2">
				                	<h6 class="col-sm-4 f-12 p-r-0">Contact</h6>
				                    <p class="col-sm-8 f-12">{{ $tenant->user->contact }}</p>
				                </div>
							@endif
							@if ($tenant->address == !null)
								<div class="row mt-2">
				                	<h6 class="col-sm-4 f-12 p-r-0">Address</h6>
				                    <p class="col-sm-8 f-12">{{ $tenant->address }}</p>
				                </div>
							@endif
							@if ($tenant->user->email == !null)
			                <div class="row">
			                	<h6 class="col-sm-4 f-12 p-r-0">Email</h6>
			                    <p class="col-sm-8 f-12">{{ $tenant->user->email }}</p>
			                </div>
			                @endif
			                @if ($tenant->user->password == !null)
				                @if(Auth::user()->id == $tenant->user->id)
				                <div class="row">
				                	<a href="#" class="btn waves-effect waves-light btn-primary p-0 btn-block"><i class="icofont icofont-life-buoy"></i><span class="f-12">Change Password</span></a>
				                </div>
				                @endif
				             @endif
							{{-- <div class="support-btn">
								<a href="#!" class="btn waves-effect waves-light btn-primary btn-block"><i class="icofont icofont-life-buoy"></i> Item support</a>
							</div> --}}
						</div>
					</div>
					<div class="card version">
						{{-- <div class="card-header borderless">
							<h5>Navigation</h5>
							<div class="card-header-right">
							<i class="icofont icofont-navigation-menu"></i>
							</div>
						</div> --}}
						<div class="card-block">
							<ul class="nav navigation">
								<li class="navigation-header" style="border-top: 0;">
									<i class="icon-history pull-right"></i> <b>Contract</b>
								</li>
								<li class="waves-effect waves-light">
									<a href="#">Generate Contract <span class="text-muted text-regular pull-right">Jan 2019</span></a>
								</li>
								<li class="navigation-header" style="border-top: 0;">
									<i class="icon-history pull-right"></i> <b>Billing</b>
								</li>
								<li class="waves-effect waves-light">
									<a href="#">Generate Bill <span class="text-muted text-regular pull-right">Aug 2019</span></a>
								</li>
								<li class="waves-effect waves-light">
									<a href="#">Electricity Bill <span class="text-muted text-regular pull-right">Aug 2019</span></a>
								 </li>
								 <li class="waves-effect waves-light">
									<a href="#">Water Bill <span class="text-muted text-regular pull-right">Aug 2019</span></a>
								 </li>
								<li class="navigation-divider"></li>
								<li class="navigation-header">
									<i class="icon-gear pull-right"></i> <b>Others</b>
								</li>
								<li class="waves-effect waves-light">
									<a href="#" target="_blank">Payment History</a>
								</li>
								<li class="waves-effect waves-light">
									<a href="#" target="_blank"> Submitted Documents</a>
								</li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-xl-8 p-0">
		<div class="col-sm-12">
			<div class="card-transparent">
				<div class="page-header-title">
					<div class="d-inline">
						<h4>Units</h4>
					</div>
				</div>
			</div>
			@if(count($leases) > 0)
				@foreach($leases as $lease)
				<div class="card m-t-10">
					<div class="card-header">
						<h5><a class="f-16" data-toggle="tooltip" data-placement="left" title="" data-original-title="View Unit Details" href="{{ route('unit.show', [$lease->unit->property->id, $lease->unit->id]) }}" title="">{{ $lease->unit->property->name }} {{ $lease->unit->number }}</a></h5>
						<label class="label @if($lease->status == 'Active') label-success @else label-danger @endif">{{ $lease->status }}</label>
						<div class="card-header-right">
							<a href="{{ route('payable.create', $lease->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Create New Payable">
				                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
				                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
				                </button>
				            </a>
							<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit Agreement">
		                        <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
		                            <i class="fa fa-pencil fa-sm" style="color: white;"></i>
		                        </button>
		                    </a>
		                    <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete Agreement">
		                        <button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
		                            <i class="fa fa-trash fa-sm" style="color: white;"></i>
		                        </button>
		                    </a>
				            
			            </div>
					</div>
					<div class="card-block">
						<div class="col">
							<div class="row m-b-15">
								<div class="col">
									<button class="btn btn-primary btn-round btn-sm waves-effect waves-light">Bill</button>
								</div>
							</div>
							<div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Tenant</h6>
			                    <p class="col-sm-9 f-12">
			                    	{{ $tenant->user->fullnamewm }}
			                    </p>
			                </div>
							<div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Date of Contract</h6>
			                    <p class="col-sm-9 f-12">
			                    	{{ date('M d, Y', strtotime($lease->date_of_contract)) }}
									<label class="label label-primary">View Contract</label>
			                    </p>
			                </div>
							<div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Term</h6>
			                    <p class="col-sm-9 f-12">
			                    	{{ date('M d, Y', strtotime($lease->term_start)) }} - {{ date('M d, Y', strtotime($lease->term_end)) }}
			                    </p>
			                </div>
			                <div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Move-in Date</h6>
			                    <p class="col-sm-9 f-12">
			                    	{{ date('M d, Y', strtotime($lease->move_in)) }}
			                    </p>
			                </div>
			                <div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Monthly Collection Date</h6>
			                    <p class="col-sm-9 f-12">
			                    	Every {{ $lease->monthly_collection_ordinal }}
			                    	<br>Next Billing <label class="label label-warning">
			                    		<?php $monthly = $lease->monthly_collection;
			                    			$date = date("M $monthly, Y", strtotime('+1 month')); ?>
			                    		{{ 	$date }}</label>
			                    </p>
			                </div>
			                <div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Last Billing Status</h6>
			                    <p class="col-sm-9 f-12">
			                    	<a href="#" title="">PAID (MM/DD/YYYY)</a>
			                    	<br>Last Billing <label class="label label-warning">
			                    		<?php $monthly = $lease->monthly_collection;
			                    			$date = date("M $monthly, Y", strtotime('-1 month')); ?>
			                    		{{ 	$date }}
			                    	</label>
			                    </p>
			                </div>
			                <div class="row">
			                	<h6 class="col-sm-3 f-14 p-r-0">Lease Price</h6>
			                    <p class="col-sm-9 f-12">
			                    	{{ $lease->agreed_lease_price_peso }}
			                    </p>
			                </div>
						</div>
						
		                <div class="row m-t-5">
		                	<div class="col-sm-12">
		                		<div class="card table-card" style="background-color: #ffffec;">
									<div class="card-header">
										<h5>Payables</h5>
										<div class="card-header-right">
											<ul class="list-unstyled card-option">
											<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
											<li><i class="feather icon-maximize full-card"></i></li>
											<li><i class="feather icon-refresh-cw reload-card"></i></li>
											<li><i class="feather icon-chevron-left open-card-option"></i></li>
											</ul>
										</div>
									</div>
									<div class="card-block">
										@if(count($payables->where('agreement_id', $lease->id)) > 0)
										<div class="table-responsive">
											<table class="table table-hover m-b-0">
												<thead>
													<tr>
														<th class="f-12">Description</th>
														<th class="f-12">Paid Amount</th>
														<th class="f-12">Amount Due</th>
														<th class="f-12">Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($payables->where('agreement_id', $lease->id) as $payable)
													<tr>
														<td class="f-12">{{ $payable->payment_type->name }}</td>
														<td class="f-12">0</td>
														<td class="f-12">{{ $payable->amount_peso }}</td>
														<td class="f-12"><label class="label label-success">Full</label></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										@else
											<span class="f-12">No payables found</span>
										@endif
									</div>
								</div>
		                	</div>
		                </div>
					</div>
				</div>
				@endforeach
			@else
				<div class="card m-t-10">
					<div class="card-block">
						<p>No units</p>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection