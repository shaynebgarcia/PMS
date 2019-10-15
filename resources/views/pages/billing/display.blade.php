@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Generate Bill - '.date('F Y', strtotime($billing_my));
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease-bill', $lease, $billing_my) }}
@endsection

@php
	$bill_from = date('F '.$latest_lease_details->monthly_due.', Y', strtotime($billing_my));
	$exclude_day = strtotime('-1 day', strtotime($bill_from));
	$bill_to = date('F d, Y', strtotime('+1 month', $exclude_day));

	$rental_price = $latest_lease_details->agreed_lease_price;
	$subtotal_subservices = $latest_sub_services->sum('agreed_amount');
	$subtotal_utilitybill = $utility_bill->sum('amount');
	$subtotal = $rental_price + $subtotal_subservices + $subtotal_utilitybill;
	$OUpayment = 0;
	$total = $subtotal + $OUpayment;
@endphp

@section('content')
	<form class="md-float-material form-material" method="POST" action="#">
		@CSRF
		<div class="card m-t-10">
			<div class="card-header">
				<h5>
					<a class="f-16" data-toggle="tooltip" data-placement="left" title="" data-original-title="View Unit Details" href="#!" title="">
						Billing Invoice
					</a>
				</h5>
				<div class="card-header-right">
					<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Publish Bill">
		                <button type="submit" class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
		                    <i class="fa fa-fax fa-sm" style="color: white;"></i>
		                </button>
		            </a>
					<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Print Bill">
	                    <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
	                        <i class="fa fa-print fa-sm" style="color: white;"></i>
	                    </button>
	                </a>
	            </div>
			</div>
			<div class="card-block">
				<div class="col">
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Invoice NO:</h6>
						</div>
						<div class="col-6 f-14 p-r-0">
							<div class="form-group form-primary">
	                            <input type="text" name="invoice_no" class="form-control fill" required="" style="height: 20px;width: 80%;">
	                            <span class="form-bar"></span>
	                        </div>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>Billing Date:</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>{{ date('M d, Y', strtotime(Carbon\Carbon::now())) }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Rental Due Date:</h6>
						</div>
						<div class="col-6 f-14 p-r-0">
							<h6>{{ date('M d, Y', strtotime($bill_from)) }}</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>Month:</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>{{ date('F Y', strtotime($billing_my)) }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Name of Tenant:</h6>
						</div>
						<div class="col-10 f-14 p-r-0">
							<h6>{{ $lease->tenant->user->fullnamewm }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Property/Unit NO:</h6>
						</div>
						<div class="col-10 f-14 p-r-0">
							<h6>{{ $lease->unit->property->name }} {{ $lease->unit->number }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-12 f-14 p-r-0 m-t-40">
							<table class="table table-responsive">
								<tbody>
									<tr>
										<th style="width: 100%; padding: 0.5rem;">Previous Billing Amount Due</th>
										<td style="padding: 0.5rem;">0000.00 PHP</td>
									</tr>
									<tr>
										<th style="padding: 0.5rem;">Previous Billing Amount Paid</th>
										<td style="padding: 0.5rem;">0000.00 PHP</td>
									</tr>
									<tr>
										<th style="padding: 0.5rem;">Over/Under-payment</th>
										<td style="padding: 0.5rem;">0000.00 PHP</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row m-t-30">
						<div class="col-12 f-14 p-r-0">
							<h6>Current Charges</h6>
						</div>
					</div>

					<div class="row">
						<div class="col-12 f-14 p-r-0">
							<table class="table table-responsive table-striped">
								<tbody>
									<tr>
										<th style="width: 20%; padding: 0.5rem;">Rental</th>
										<td style="width: 70%; padding: 0.5rem;">
											{{ $bill_from }} to {{ $bill_to }}
										</td>
										<td style="width: 10%; padding: 0.5rem;">
											{{ $latest_lease_details->agreed_lease_price_currency_code }}
										</td>
									</tr>

									{{-- FOREACH Service Subscriptions --}}
									@foreach($latest_sub_services as $sub_service)
									<tr>
										<th style="width: 20%; padding: 0.5rem;">{{ $sub_service->service_type->name }}</th>
										<td style="width: 40%; padding: 0.5rem;"></td>
										<td style="width: 40%; padding: 0.5rem;">{{ $sub_service->agreed_amount_currency_code }}</td>
									</tr>
									@endforeach

									{{-- FOREACH Utilities Subscriptions --}}
									<tr>
										<th style="width: 20%; padding: 0.5rem;">Utilities</th>
										<td style="width: 40%; padding: 0.5rem;"></td>
										<td style="width: 40%; padding: 0.5rem;"></td>
									</tr>
									@foreach($utility_bill as $ubill)
									<tr>
										<th style="padding: 0.5rem 2rem;">{{ $ubill->utility->type }}</th>
										<td style="width: 40%; padding: 0.5rem;">September 01 to August 02, 2019</td>
										<td style="padding: 0.5rem;">{{ $ubill->amount_currency_code }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="row m-t-40">
				        <!-- accepted payments column -->
				        <div class="col-6">
				          <p class="lead">Payment Methods:</p>
				          <img src="../../dist/img/credit/visa.png" alt="Visa">
				          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
				          <img src="../../dist/img/credit/american-express.png" alt="American Express">
				          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

				          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				            Please pay directly to BDO Bank Direct Deposit of CITYDORMS CORP. SA#6860054688. <br>
				            Always bring this notice with you when making payments.Kindly give copy of deposit slip to Bldg Caretaker. <br><br>
				            Please pay on or before the following date to avoid disconection: (MM/DD/YYYY) <br>
				            Reconnection fee for cut-off facilities is P300.00 and service fee for cash payment pick-up is P300.00.
				          </p>
				        </div>
				        <!-- /.col -->
				        <div class="col-6">
				          <p class="lead">Amount Due 01/01/2019</p>

				          <div class="table-responsive">
				            <table class="table">
				              <tbody><tr>
				                <th style="width: 80%">Subtotal:</th>
				                <td>{{ number_format($subtotal, 2)." ".config('pms.currency.code') }}</td>
				              </tr>
				              <tr>
				                <th>Over/Under-payment (+/-)</th>
				                <td>{{ number_format($OUpayment, 2)." ".config('pms.currency.code') }}</td>
				              </tr>
				              <tr>
				                <th>Total:</th>
				                <td>{{ number_format($total, 2)." ".config('pms.currency.code') }}</td>
				              </tr>
				            </tbody></table>
				          </div>
				        </div>
				        <!-- /.col -->
				    </div>

				    <div class="row m-t-40">
				    	<div class="col-2 f-14 p-r-0">
				    		<h6>Prepared By:</h6>
				    	</div>
				    	<div class="col-4 f-14 p-r-0 p-l-0">
				    		<div class="form-group form-primary">
	                            <input type="text" name="prepared_by" class="form-control fill" required="" style="height: 20px;width: 80%;">
	                            <span class="form-bar"></span>
		                    </div>
				    	</div>
				    	<div class="col-2 f-14 p-r-0">
				    		<h6>Received By:</h6>
				    		<h6>Date:</h6>
				    	</div>
				    	<div class="col-4 f-14 p-r-0">
				    		<div class="form-group form-primary">
	                            <input type="text" name="received_by" class="form-control fill" style="height: 20px;width: 80%;">
	                            <span class="form-bar"></span>
		                    </div>
		                    <div class="form-group form-primary">
	                            <input type="text" name="date_received_by" class="form-control fill" style="height: 20px;width: 80%;">
	                            <span class="form-bar"></span>
		                    </div>
				    	</div>
				    </div>
				</div>
			</div>
			<div class="card-footer">
			</div>
		</div>
	</form>
@endsection