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
							<a href="
								{{ route('billing.display',
								[	$lease->unit->property->id, 
									$lease_detail->id,
									$bill_this
								])}}">
								Generate Bill
								<span class="text-muted text-regular pull-right">
									{{ date('M Y', strtotime($bill_this)) }}
								</span>
							</a>
						</li>
						<li class="waves-effect waves-light">
							<a href="#">Electricity Bill <span class="text-muted text-regular pull-right">Aug 2019</span></a>
						 </li>
						 <li class="waves-effect waves-light">
							<a href="#">Water Bill <span class="text-muted text-regular pull-right">Aug 2019</span></a>
						 </li>
						 <li class="waves-effect waves-light">
							<a href="#" id="getPastBill">Generate Past Billing</a>
						</li>
						 <li class="waves-effect waves-light">
							<a href="#" id="getPastBill">Billing History</a>
						</li>
						{{-- <li class="navigation-divider"></li>
						<li class="navigation-header">
							<i class="icon-gear pull-right"></i> <b>Others</b>
						</li>
						<li class="waves-effect waves-light">
							<a href="#" target="_blank">Payment History</a>
						</li>
						<li class="waves-effect waves-light">
							<a href="#" target="_blank"> Submitted Documents</a>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- <div class="card latest-update-card">
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
</div> --}}