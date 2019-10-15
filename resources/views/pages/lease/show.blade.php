@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.widget-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Leasing Agreement';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease-show', $property, $lease) }}
@endsection

@section('content')
	<div class="row">
		<div class="col-4">
			<div id="navigation">
				<div class="row">
					<div class="col-lg-12">
						<div class="card version">
							{{-- <div class="card-header borderless">
								<h5>Navigation</h5>
								<div class="card-header-right">
								<i class="icofont icofont-navigation-menu"></i>
								</div>
							</div> --}}
							<div class="card-block m-t-20">
								<ul class="nav navigation">
									<li class="navigation-header" style="border-top: 0;">
										<i class="icon-history pull-right"></i> <b>Contract</b>
									</li>
									<li class="waves-effect waves-light">
										<a href="#">Generate Contract <span class="text-muted text-regular pull-right">Jan 2019</span></a>
									</li>
									<li class="waves-effect waves-light">
										<a href="#">Renew Contract <span class="text-muted text-regular pull-right">Jan 2020</span></a>
									</li>
									<li class="waves-effect waves-light">
										<a href="#">Contract History</a>
									</li>
									<li class="navigation-header" style="border-top: 0;">
										<i class="icon-history pull-right"></i> <b>Billing</b>
									</li>
									<li class="waves-effect waves-light">
										<a href="{{ route('billing.display', [$lease_detail->id, $bill_month_now]) }}">Generate Bill <span class="text-muted text-regular pull-right">{{ date('M Y', strtotime(Carbon\Carbon::now())) }}</span></a>
									</li>
									<li class="waves-effect waves-light">
										<a href="#" id="getPastBill">Generate Past Billing</a>
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
			<div class="card latest-update-card">
				<div class="card-header">
					<h5>Latest Activity</h5>
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
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 290px;">
						<div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
							<div class="latest-update-box">
								<div class="row p-t-20 p-b-30">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-primary update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Devlopment &amp; Update</h6></a>
									<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
									</div>
								</div>
								<div class="row p-b-30">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-primary update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Showcases</h6></a>
									<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
									</div>
								</div>
								<div class="row p-b-30">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-success update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Miscellaneous</h6></a>
									<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
									</div>
								</div>
								<div class="row p-b-30">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-primary update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Showcases</h6></a>
									<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
									</div>
								</div>
								<div class="row p-b-30">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-success update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Miscellaneous</h6></a>
									<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
									</div>
								</div>
								<div class="row">
									<div class="col-auto text-right update-meta p-r-0">
									<i class="b-danger update-icon ring"></i>
									</div>
									<div class="col p-l-5">
									<a href="#!"><h6>Your Manager Posted.</h6></a>
									<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 173.76px;"></div>
						<div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-8">
			<div class="p-b-10">
				<button class="btn btn-sm btn-primary waves-effect waves-light">Add Payment</button>
				<button class="btn btn-sm btn-primary waves-effect waves-light">Primary Button</button>
				<button class="btn btn-sm btn-primary waves-effect waves-light">Primary Button</button>
			</div>

			<div class="card">
				<div class="card-header">
					<h5>
						Agreement Information
					</h5>
					<div class="card-header-right">
						<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit Agreement">
		                    <button class="btn waves-effect waves-light btn-primary btn-icon" data-toggle="modal" data-target="#edit-Modal" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
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
						<div class="row">
		                	<h6 class="col-sm-3 f-14 p-r-0">Property/Unit</h6>
		                    <p class="col-sm-9 f-12">
		                    	{{ $lease->unit->property->name }} {{ $lease->unit->number }}
		                    </p>
		                </div>
						<div class="row">
		                	<h6 class="col-sm-3 f-14 p-r-0">Tenant</h6>
		                    <p class="col-sm-9 f-12">
		                    	{{ $lease->tenant->user->fullnamewm }}
		                    </p>
		                </div>
						<div class="row">
		                	<h6 class="col-sm-3 f-14 p-r-0">Term</h6>
		                    <p class="col-sm-9 f-12">
		                    	{{ date('M d, Y', strtotime($lease_detail->term_start)) }} - {{ date('M d, Y', strtotime($lease_detail->term_end)) }}
		                    	<label class="label @if($lease_detail->status == 'Active') label-success @else label-default @endif">{{ $lease_detail->status }}</label>
		                    </p>
		                </div>
		                <div class="row">
		                	<h6 class="col-sm-3 f-14 p-r-0">Move-in Date</h6>
		                    <p class="col-sm-9 f-12">
		                    	{{ date('M d, Y', strtotime($lease_detail->first_day)) }}
		                    </p>
		                </div>
		                <div class="row">
		                	<h6 class="col-sm-3 f-14 p-r-0">Lease Price</h6>
		                    <p class="col-sm-9 f-12">
		                    	{{ $lease_detail->agreed_lease_price_currency_sign }}
		                    </p>
		                </div>
					</div>
				</div>
			</div>
			<div class="card table-card" style="background-color: #ffffec;">
				<div class="card-header">
					<h5>Payments</h5>
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
					@if(count($lease->payments) > 0)
					<div class="table-responsive">
						<table class="table table-hover m-b-0">
							<thead>
								<tr>
									<th class="f-12">Invoice NO</th>
									<th class="f-12">Description</th>
									<th class="f-12">Amount Due</th>
									<th class="f-12">Amount Paid</th>
									<th class="f-12">Status</th>
									<th class="f-12">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($lease->payments as $payment)
								<tr>
									<td class="f-12">{{ $payment->reference_no }}</td>
									<td class="f-12">{{ $payment->payment_type->name }}</td>
									<td class="f-12">{{ $payment->amount_due_currency_sign }}</td>
									<td class="f-12">{{ $payment->amount_paid_currency_sign }}</td>
									<td class="f-12">
										@if($payment->amount_due == $payment->amount_paid)
											<label class="label label-success">
												Full
											</label>
										@else
											<label class="label label-warning">
												Partial
											</label>
										@endif
									</td>
									<td class="f-12"></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
						<p class="f-12 m-20">No payments found</p>
					@endif
				</div>
				{{-- <div class="card-footer">
					<button type="button" class="btn btn-inverse waves-effect waves-light" title="">
						Inverse button
					</button>
				</div> --}}
			</div>
			<div class="card table-card">
				<div class="card-header">
					<h5>Billing</h5>
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
					@if(count($billings->where('agreement_id', $lease->id)) > 0)
					<div class="table-responsive">
						<table class="table table-hover m-b-0">
							<thead>
								<tr>
									<th class="f-12">Invoice</th>
									<th class="f-12">Paid Amount</th>
									<th class="f-12">Amount Due</th>
									<th class="f-12">Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($billings->where('agreement_id', $lease->id) as $billing)
								<tr>
									<td class="f-12">{{ $billing->payment_type->name }}</td>
									<td class="f-12">0</td>
									<td class="f-12">{{ $billing->amount_currency_sign }}</td>
									<td class="f-12"><label class="label label-success">Full</label></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
						<p class="f-12 m-20">No published billing found</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="modal fade" id="edit-Modal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Modal title</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
			<h5>Default Modal</h5>
			<p>This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
			</div>
			</div>
			</div>
		</div>
	</div>
@endsection

@section('js-plugin')
    @include('includes.custom-scripts.swal-pastbilling')
@endsection

