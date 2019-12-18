@extends('layouts.admindek', ['pageSlug' => 'billing-display'])

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.bill.icon');
        $breadcrumb_title = config('pms.breadcrumbs.bill.bill-display.title').FY($billing_my);
        $breadcrumb_subtitle = config('pms.breadcrumbs.bill.bill-display.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-bill-display', $property, $lease, $lease_detail, $billing_my) }}
@endsection

@section('content')

@if ($errors->any())
	<div class="alert alert-danger icons-alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<i class="icofont icofont-close-line-circled"></i>
		</button>
		@foreach ($errors->all() as $error)
			<p><strong>Oops!</strong> {{ $error }}</p>
		@endforeach
	</div>
@endif

	<form name="publish-bill" class="md-float-material form-material" method="POST" action="{{ route('billing.publish', [$lease->id, $lease_detail->id, $billing_my]) }}">
		@csrf
		<div class="card m-t-10">
			<div class="card-header">
				<h5>Billing Invoice</h5>
				<div class="card-header-right">
	                <button type="submit" class="btn waves-effect waves-light btn-success btn-icon" onclick="btnPublish()"
	                data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Publish Bill"style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
	                    <i class="fa fa-fax fa-sm" style="color: white;"></i>
	                </button>
					{{-- <a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Print Bill" >
	                    <button class="btn waves-effect waves-light btn-primary btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
	                        <i class="fa fa-print fa-sm" style="color: white;"></i>
	                    </button>
	                </a> --}}
	            </div>
			</div>
			<div class="card-block">
				<div class="col">
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Invoice NO:</h6>
						</div>
						<div class="col-6 f-14 p-r-0">
							<h6>{{ $invoice_no }}</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>Billing Date:</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>{{ $bill_date }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Rental Due Date:</h6>
						</div>
						<div class="col-6 f-14 p-r-0">
							<h6>{{ $lease_detail->MdY('M', 'd', 'Y', $bill_from) }}</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>Month:</h6>
						</div>
						<div class="col-2 f-14 p-r-0">
							<h6>{{ FY($billing_my) }}</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-2 f-14 p-r-0">
							<h6>Name of Tenant:</h6>
						</div>
						<div class="col-10 f-14 p-r-0">
							@foreach($lease->tenant_list as $tl)
	                            <h6>{{ $tl->tenant->user->fullnamewm }}</h6>
	                        @endforeach 
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
										<th style="width: 100%; padding: 0.5rem;">Previous Billing Amount Due
											@if($last_bill != null) ({{ FY($last_bill->monthyear) }}) @endif </th>
										<td style="padding: 0.5rem;">@if($last_bill != null) {{ currencycode($last_bill->total_amount_due) }} @else 0.00 PHP @endif</td>
									</tr>
									<tr>
										<th style="padding: 0.5rem;">Previous Billing Amount Paid</th>
										<td style="padding: 0.5rem;">@if($prev_billing_payment != null) {{ currencycode($prev_billing_payment->amount_paid) ?? 0 }} @else 0.00 PHP @endif </td>
									</tr>
									<tr>
										<th style="padding: 0.5rem;">Over/Under-payment</th>
										<td style="padding: 0.5rem;">{{ currencycode($OUpayment, 2) ?? 0 }}</td>
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
											@if($rental_price != 0)
												{{ $bill_from }} to {{ $bill_to }}
											@else
												<span class="text-danger">FOR TERMINATION</span>
											@endif
										</td>
										<td style="width: 10%; padding: 0.5rem;">
											@if($rental_price != 0)
												{{ currencycode($lease_detail->agreed_lease_price) }}
											@else
												<span class="text-danger">FOR TERMINATION</span>
											@endif
										</td>
									</tr>

									{{-- FOREACH Service Subscriptions --}}
									@foreach($latest_sub_services as $sub_service)
									<tr>
										<th style="width: 20%; padding: 0.5rem;">{{ $sub_service->service_type->name }}</th>
										<td style="width: 40%; padding: 0.5rem;">{{ FdY($sub_service->start_date) }} to {{ FdY($sub_service->end_date) }}</td>
										<td style="width: 40%; padding: 0.5rem;">{{ currencycode($sub_service->amount) }}</td>
									</tr>
									{{-- <tr>
										<th style="width: 20%; padding: 0.5rem;">{{ $sub_service->service_type->name }}</th>
										<td style="width: 40%; padding: 0.5rem;">
											{{ FdY($sub_service->start_date) }} to {{ $bill_to }}
											
										@php
											$excess_date = date_diff(date_create(Ymd($sub_service->start_date)), date_create(Ymd($bill_from)))->format("%a");
										@endphp</td>
										<td style="width: 40%; padding: 0.5rem;">{{ currencycode($sub_service->agreed_monthly_rate + $sub_service->agreed_daily_rate * $excess_date) }}</td>
									</tr> --}}
									@endforeach

									{{-- FOREACH Utilities --}}
									<tr>
										<th style="width: 20%; padding: 0.5rem;">Utilities</th>
										<td style="width: 40%; padding: 0.5rem;"></td>
										<td style="width: 40%; padding: 0.5rem;"></td>
									</tr>
									@foreach($utility_bill as $ubill)
									<tr>
										<th style="padding: 0.5rem 2rem;">{{ $ubill->utility->type }}</th>
										<td style="width: 40%; padding: 0.5rem;">{{ FdY($ubill->start_date) }} to {{ FdY($ubill->end_date) }}</td>
										<td style="padding: 0.5rem;">{{ currencycode($ubill->amount) }}</td>
									</tr>
									@endforeach

									{{-- FOREACH Other Billings --}}
									<tr>
										<th style="width: 20%; padding: 0.5rem;">Other</th>
										<td style="width: 40%; padding: 0.5rem;"></td>
										<td style="width: 40%; padding: 0.5rem;"></td>
									</tr>
									@foreach($other_bill as $obill)
									<tr>
										<th style="padding: 0.5rem 2rem;">{{ $obill->income_type->name }}</th>
										<td style="width: 40%; padding: 0.5rem;"></td>
										<td style="padding: 0.5rem;">{{ currencycode($obill->total_amount) }}</td>
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
				          {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
				          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
				          <img src="../../dist/img/credit/american-express.png" alt="American Express">
				          <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

				          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				            Please pay directly to BDO Bank Direct Deposit of CITYDORMS CORP. SA#6860054688. <br>
				            Always bring this notice with you when making payments. Kindly give copy of deposit slip to Bldg Caretaker. <br><br>
				            Please pay on or before the following date to avoid disconnection: <br> {{ MdY(config('pms.billing.invoice.after_due_date'), strtotime($bill_from)) }}<br>
				            Reconnection fee for cut-off facilities is P300.00 and service fee for cash payment pick-up is P300.00.
				          </p>
				        </div>
				        <!-- /.col -->
				        <div class="col-6">
				          <p class="lead">Amount Due {{ mdY_bslash($bill_from) }}</p>

				          <div class="table-responsive">
				            <table class="table">
				              <tbody><tr>
				                <th style="width: 80%">Subtotal:</th>
				                <td>{{ currencycode($subtotal) }}</td>
				              </tr>
				              <tr>
				                <th>Over/Under-payment (+/-)</th>
				                <td>{{ currencycode($OUpayment) }}</td>
				              </tr>
				              <tr>
				                <th>Total:</th>
				                <td>{{ currencycode($total) }}</td>
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
	                            <input type="text" name="prepared_by" class="form-control fill" required="" style="height: 20px;width: 80%;" required>
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

@section('js-plugin')
	@include('includes.swal.publish-bill')
@endsection

