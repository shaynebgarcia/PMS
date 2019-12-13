				<nav class="navbar header-navbar pcoded-header">
					<div class="navbar-wrapper">
						<div class="navbar-logo">
							<a href="{{ route('dashboard') }}">
								<span style="font-size: x-large;letter-spacing: 17px;">PMS</span>
								{{-- <img class="img-fluid" src="{{ asset('admindek/files/assets/images/logo.png') }}" alt="Theme-Logo" /> --}}
							</a>
							<a class="mobile-menu" id="mobile-collapse" href="#!">
								<i class="feather icon-menu icon-toggle-right"></i>
							</a>
							<a class="mobile-options waves-effect waves-light">
								<i class="feather icon-more-horizontal"></i>
							</a>
						</div>
						<div class="navbar-container container-fluid">
							<ul class="nav-left">
								{{-- <li class="header-search">
									<div class="main-search morphsearch-search">
										<div class="input-group">
										<span class="input-group-prepend search-close">
										<i class="feather icon-x input-group-text"></i>
										</span>
										<input type="text" class="form-control" placeholder="Enter Keyword">
										<span class="input-group-append search-btn">
										<i class="feather icon-search input-group-text"></i>
										</span>
										</div>
									</div>
								</li> --}}
								<li class="co-text" style="padding-left: 2rem;">
									{{ config('pms.company.name') }}
								</li>
								<li>
									<a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light" data-cf-modified-a03e1dd1be4b097e43526b44-="">
										<i class="full-screen feather icon-maximize"></i>
									</a>
								</li>
							</ul>
							<ul class="nav-right">
								<li class="header-notification">
									<div class="dropdown-primary dropdown">
										<div class="dropdown-toggle" data-toggle="dropdown">
											<i class="feather icon-bell"></i>
											<span class="badge bg-c-red">5</span>
										</div>
										<ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
											<li>
												<h6>Notifications</h6>
												<label class="label label-danger">New</label>
											</li>
											<li>
												<div class="media">
													<img class="img-radius" src="{{ asset('admindek/files/assets/images/avatar-4.jpg') }}" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class="notification-user">John Doe</h5>
														<p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
														<span class="notification-time">30 minutes ago</span>
													</div>
												</div>
											</li>
											<li>
												<div class="media">
													<img class="img-radius" src="{{ asset('admindek/files/assets/images/avatar-3.jpg') }}" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class="notification-user">Joseph William</h5>
														<p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
														<span class="notification-time">30 minutes ago</span>
													</div>
												</div>
											</li>
											<li>
												<div class="media">
													<img class="img-radius" src="{{ asset('admindek/files/assets/images/avatar-4.jpg') }}" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class="notification-user">Sara Soudein</h5>
														<p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
														<span class="notification-time">30 minutes ago</span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</li>
								<li class="header-notification">
									<div class="dropdown-primary dropdown">
										<div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
										<i class="feather icon-tag"></i>
										@php
											$billings = App\Billing::where('property_id', $property->id)->get();
											$near_due = DB::table('billings')
								                     ->whereBetween('due_date', array(date('Y-m-d', strtotime('-14 days', strtotime(Carbon\Carbon::now()))), date('Y-m-d', strtotime(Carbon\Carbon::now()))))->get();
										@endphp
											<span class="badge bg-c-green">{{ count($near_due) }}</span>
										</div>
									</div>
								</li>
								<div id="sidebar" class="users p-chat-user showChat" style="display: none;">
									<div class="had-container">
										<div class="p-fixed users-main">
											<div class="user-box">
												<div class="chat-search-box">
													<a class="back_friendlist">
													<i class="feather icon-x"></i>
													</a>
													<div class="right-icon-control">
													<div class="input-group input-group-button">
													<input type="text" id="search-friends" name="footer-email" class="form-control" placeholder="Search">
													<div class="input-group-append">
													<button class="btn btn-primary waves-effect waves-light" type="button"><i class="feather icon-search"></i></button>
													</div>
													</div>
													 </div>
												</div>
												<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 587px;">
												<div class="main-friend-list" style="overflow: hidden; width: auto; height: 587px;">
													<div class="media userlist-header waves-effect waves-light">
														<h6>Near Rental Due Date</h6>
													</div>
													@php
														$leasing_agreements = App\LeasingAgreement::where('property_id', $property->id)->get();
													@endphp
													@foreach($leasing_agreements as $lease)
														@php
															$latest_agreement = App\LeasingAgreementDetail::where('property_id', $property->id)->where('leasing_agreement_id', $lease->id)->where('status_id', 6)->first();

															$billings = App\Billing::where('property_id', $property->id)->get();
															$payments = App\Payment::where('property_id', $property->id)->where('payment_type_id', 1)->get();

						                                    $last_bill = $billings->where('leasing_agreement_details_id', $latest_agreement->id)->last();

						                                    $bill_month_now = Carbon\Carbon::now()->format('MY');
						                                    $bill_month_next = date('MY', strtotime('+1 month', strtotime($latest_agreement->first_day)));

						                                    if ($last_bill != null) {
						                                        $bill_this = date('MY', strtotime('+1 month', strtotime($last_bill->billing_from)));
						                                        $is_paid = $payments->where('billing_id', $last_bill->id)->first();
						                                    } else {
						                                        $bill_this = $bill_month_next;
						                                        $last_bill = null;
						                                        $is_paid = null;
						                                    }

						                                    $billing_my = MY($bill_this);

						                                    $bill_from = $latest_agreement->bill_from($billing_my);
						                                    $bill_to = $latest_agreement->bill_to($bill_from);
						                                    $bill_due = $latest_agreement->bill_due($bill_from);
						                                @endphp

						                                @if((strtotime('-14 days', strtotime($bill_due))) <= strtotime(Carbon\Carbon::now()) || ($is_paid == null))
							                                <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online" data-username="{{ $lease->details->last()->agreement_no }}">
																<div class="bill-status">
																	@if($last_bill != null)
																		@if($last_bill->monthyear == date('MY', strtotime(Carbon\Carbon::now())))
																			@if($is_paid != null)
																				<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" class="waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																					<i class="feather icon-tag text-c-green"></i>
																				</a>
																				@php $status = 'Latest invoice published and paid'; @endphp
																			@else
																				<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" class="waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																					<i class="feather icon-tag text-c-yellow"></i>
																				</a>
																				@php $status = 'Latest invoice published and unpaid'; @endphp
																			@endif
																		@elseif($last_bill->monthyear != date('MY', strtotime('-1 month', strtotime(Carbon\Carbon::now()))))
																			<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" class="waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																				<i class="feather icon-tag text-c-red"></i>
																			</a>
																			@php $status = 'Several invoices have not been published'; @endphp
																		@else
																			@if($is_paid != null)
																				<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" class="waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																					<i class="feather icon-tag text-c-green"></i>
																				</a>
																				@php $status = 'Last invoice is published and paid'; @endphp
																			@else
																				<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" class="waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																					<i class="feather icon-tag text-c-red"></i>
																				</a>
																				@php $status = 'Last invoice published and unpaid'; @endphp
																			@endif
																		@endif
																		
																	@else
																			<a href="{{ route('billing.display', [$lease->id, $latest_agreement->id, $bill_this]) }}" data-toggle="tooltip" data-placement="left" title="Generate Bill: {{ date('F Y', strtotime($bill_this)) }}">
																				<i class="feather icon-tag text-muted"></i></a>
																			@php $status = 'Last invoice not found'; @endphp
																	@endif
																</div>
																<div class="media-body" data-toggle="tooltip" data-placement="left"
																title="{{ $status }}">
																	<div class="chat-header">
																		{{ $lease->details->last()->agreement_no }}
																	</div>
																	<div class="chat-body">
																		{{ $lease->unit->number }} - 
																		@foreach($lease->tenant_list as $tl)
																			{{ $tl->tenant->user->fullname }},
																			@if ($loop->last)
																				{{ $tl->tenant->user->fullname }}
																			@endif
																		@endforeach
																	</div>
																	<small class="d-block text-muted">
																		Due Date: {{ $bill_due }} <br>
																		Billing Date: {{ Carbon\Carbon::createFromTimeStamp(strtotime('-7 days', strtotime($bill_due)))->diffForHumans() }}<br>
																		@if($last_bill != null)
																			@if($last_bill->monthyear )
																			@endif
																			Last Bill: {{ date('M Y', strtotime($last_bill->monthyear)) }} ({{ $last_bill->invoice_no }}) <br>
																			@if($is_paid != null)
																				<label class="label label-success">PAID</label>
																				{{-- Payment: {{ $payments->where('billing_id', $last_bill->id)->first()->reference_no }} ({{ $payments->where('billing_id', $last_bill->id)->first()->date_paid }}) --}}
																			@else
																				<label class="label label-warning">UNPAID</label>
																			@endif
																		@endif
																		
																	</small>
																</div>
															</div>
						                                @else
						                                	{{-- <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online" data-username="">
																<div class="media-body">
																	<div class="chat-header">
																		No unpublished invoice that are due in 14 days
																	</div>
																</div>
															</div> --}}
						                                @endif
													@endforeach
												</div>
												<div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 587px;">
												</div>
												<div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
											</div>
										</div> 
									</div>
								</div>
								<li class="user-profile header-notification">
									<div class="dropdown-primary dropdown">
										<div class="dropdown-toggle" data-toggle="dropdown">
											<img src="@if(Auth::user()->image_file_id == null) https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png @else {{ asset(Storage::url(Auth::user()->avatar->path)) }} @endif" class="img-radius" alt="User-Profile-Image">
											<span>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
											<i class="feather icon-chevron-down"></i>
										</div>
										<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
											<li>
												<small>You are currently managing:</small>
												<h5>{{ $property->name }}</h5>
											</li>
											<li>
												<a href="{{ route('property.switch') }}">
												<i class="feather icon-external-link"></i> Switch Property
												</a>
											</li>
											<li>
												<a href="#!">
												<i class="feather icon-settings"></i> Settings
												</a>
											</li>
											<li>
												<a href="auth-lock-screen.html">
												<i class="feather icon-lock"></i> Lock Screen
												</a>
											</li>
											<li>
												<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
													<i class="feather icon-log-out"></i> Logout
												</a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                                        @csrf
			                                    </form>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>