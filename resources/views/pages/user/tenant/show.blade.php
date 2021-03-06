@extends('layouts.admindek', ['pageSlug' => 'tenant-show'])

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = $tenant->user->fullnamewm;
		$breadcrumb_subtitle = config('pms.breadcrumbs.user.tenant-show.subtitle');
    @endphp
    {{ Breadcrumbs::render('tenant-show', $property, $tenant) }}
@endsection

@section('content')

@if (session('assign'))
    <div class="alert alert-info icons-alert">
        <p>{!! session('assign') !!}</p>
    </div>
@endif

<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div id="navigation">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header borderless">
							<h5>{{ $tenant->user->fullnamewm }}</h5>
						</div>
						<div class="card-block">
							<img src="@if($tenant->user->image_file_id == null) https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png @else {{asset(Storage::url($avatar->path))}} @endif"  class="img-radius img-100" alt="user.png" style="margin:0 30% 0 30%;">
							@if ($tenant->user->lastname == !null)
								<div class="row mt-4">
				                	<p class="col-4 f-12 p-r-0">Last Name</p>
				                    <p class="col-8 f-12">{{ $tenant->user->lastname }}</p>
				                </div>
							@endif
							@if ($tenant->user->firstname == !null)
								<div class="row mt-2">
				                	<p class="col-4 f-12 p-r-0">First Name</p>
				                    <p class="col-8 f-12">{{ $tenant->user->firstname }}</p>
				                </div>
							@endif
							@if ($tenant->user->middlename == !null)
								<div class="row mt-2">
				                	<p class="col-4 f-12 p-r-0">Middle Name</p>
				                    <p class="col-8 f-12">{{ $tenant->user->middlename }}</p>
				                </div>
							@endif
							@if ($tenant->contact == !null)
								<div class="row mt-2">
				                	<p class="col-4 f-12 p-r-0">Contact</p>
				                    <p class="col-8 f-12">{{ $tenant->contact }}</p>
				                </div>
							@endif
							@if ($tenant->user->email == !null)
			                <div class="row">
			                	<p class="col-4 f-12 p-r-0">Email</p>
			                    <p class="col-8 f-12">{{ $tenant->user->email }}</p>
			                </div>
			                @endif
			                @if ($tenant->user->password == !null)
				                @if(Auth::user()->id == $tenant->user->id)
				                <div class="row">
				                	<a href="#" class="btn waves-effect waves-light btn-primary p-0 btn-block"><i class="icofont icofont-life-buoy"></i><span class="f-12">Change Password</span></a>
				                </div>
				                @endif
				             @endif

						</div>
					</div>
					<!-- <div class="card version">
						<div class="card-block">
							<ul class="nav navigation">
								<li class="waves-effect waves-light">
									<a href="#" target="_blank">Create Leasing Agreement</a>
								</li>
								<li class="waves-effect waves-light">
									<a href="#" target="_blank">Payment History</a>
								</li>
								<li class="waves-effect waves-light">
									<a href="#" target="_blank"> Submitted Documents</a>
								</li>
							</ul>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-xl-8 p-0">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Tenant Information</h5>
					<div class="card-header-right">
						<div class="btn-group">
							<i class="icofont icofont-navigation-menu waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(2px, 46px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item waves-effect waves-light" href="{{ route('tenant.edit', $tenant->id) }}">Edit Tenant Details</a>
							<a class="dropdown-item waves-effect waves-light" href="{{ route('tenant.destroy', $tenant->id) }}">Delete Tenant</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-block">

					<h6 class="f-w-600 m-b-20">Personal Details</h6>
					<div class="m-l-20">
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Date of Birth</p>
		                    <p class="col-8 f-12">{{ $tenant->birthdate ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Age</p>
		                    <p class="col-8 f-12">{{ $tenant->age ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Place of Birth</p>
		                    <p class="col-8 f-12">{{ $tenant->birthplace ?? '---' }}</p>
		                </div>
					</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Addresses</h6>
					<div class="m-l-20">
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Previous Address</p>
		                    <p class="col-8 f-12">{{ $tenant->address ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Previous Address Tel</p>
		                    <p class="col-8 f-12">{{ $tenant->address_tel ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Provincial Address</p>
		                    <p class="col-8 f-12">{{ $tenant->address2 ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Provincial Address Tel</p>
		                    <p class="col-8 f-12">{{ $tenant->address2_tel ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Manila Address</p>
		                    <p class="col-8 f-12">{{ $tenant->address3 ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Manila Address Tel</p>
		                    <p class="col-8 f-12">{{ $tenant->address3_tel ?? '---' }}</p>
		                </div>
					</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Occupation</h6>
					<div class="m-l-20">
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Occupation</p>
		                    <p class="col-8 f-12">{{ $tenant->occupation ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Employer's Name</p>
		                    <p class="col-8 f-12">{{ $tenant->emp_name ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Office Address</p>
		                    <p class="col-8 f-12">{{ $tenant->office_address ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Office Tel</p>
		                    <p class="col-8 f-12">{{ $tenant->office_tel ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Years with Employer</p>
		                    <p class="col-8 f-12">{{ $tenant->yrs_w_emp ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Previous Employer's Name</p>
		                    <p class="col-8 f-12">{{ $tenant->prev_emp_name ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Previous Employer's Address</p>
		                    <p class="col-8 f-12">{{ $tenant->prev_emp_address ?? '---' }}</p>
		                </div>
					</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Relatives</h6>
					{{-- SPOUSE --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">Spouse</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Full Name</p>
				                    <p class="col-8 f-12">{{ $tenant->spouse_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Occupation</p>
				                    <p class="col-8 f-12">{{ $tenant->spouse_occupation ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Name</p>
				                    <p class="col-8 f-12">{{ $tenant->spouse_emp_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Address</p>
				                    <p class="col-8 f-12">{{ $tenant->spouse_emp_address ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Tel</p>
				                    <p class="col-8 f-12">{{ $tenant->spouse_emp_tel }}</p>
				                </div>
							</div>
						</div>
					{{-- FATHER --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">Father</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Full Name</p>
				                    <p class="col-8 f-12">{{ $tenant->rel1_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Occupation</p>
				                    <p class="col-8 f-12">{{ $tenant->rel1_occupation ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Name</p>
				                    <p class="col-8 f-12">{{ $tenant->rel1_emp_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Address</p>
				                    <p class="col-8 f-12">{{ $tenant->rel1_emp_address ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Father's Employer's Tel</p>
				                    <p class="col-8 f-12">{{ $tenant->rel1_emp_tel ?? '---' }}</p>
				                </div>
							</div>
						</div>
					{{-- MOTHER --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">Mother</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Full Name</p>
				                    <p class="col-8 f-12">{{ $tenant->rel2_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Occupation</p>
				                    <p class="col-8 f-12">{{ $tenant->rel2_occupation ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Name</p>
				                    <p class="col-8 f-12">{{ $tenant->rel2_emp_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Address</p>
				                    <p class="col-8 f-12">{{ $tenant->rel2_emp_address ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Employer's Tel</p>
				                    <p class="col-8 f-12">{{ $tenant->rel2_emp_tel ?? '---' }}</p>
				                </div>
							</div>
						</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Educational Attainment</h6>
					<div class="m-l-20">
						{{-- Masters --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">Masters</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">College Univeristy</p>
				                    <p class="col-8 f-12">{{ $tenant->masters ?? '---' }}</p>
				                </div>
							</div>
						</div>
						{{-- College --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">College</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">College Univeristy</p>
				                    <p class="col-8 f-12">{{ $tenant->college_uni ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Course</p>
				                    <p class="col-8 f-12">{{ $tenant->college_course ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Year Graduated</p>
				                    <p class="col-8 f-12">{{ $tenant->college_yr ?? '---' }}</p>
				                </div>
							</div>
						</div>
						{{-- Highschool --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">High School</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">School</p>
				                    <p class="col-8 f-12">{{ $tenant->hs_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Year Graduated</p>
				                    <p class="col-8 f-12">{{ $tenant->hs_yr ?? '---' }}</p>
				                </div>
							</div>
						</div>
						{{-- Gradeschool --}}
						<div class="m-l-20">
							<h6 class="f-w-600 f-14 m-t-20 m-b-20">Grade School</h6>
							<div class="m-l-20">
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">School</p>
				                    <p class="col-8 f-12">{{ $tenant->gs_name ?? '---' }}</p>
				                </div>
								<div class="row">
				                	<p class="col-3 f-12 p-r-0">Year Graduated</p>
				                    <p class="col-8 f-12">{{ $tenant->gs_yr ?? '---' }}</p>
				                </div>
							</div>
						</div>
					</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Person to Contact In Case of Emergency</h6>
					<div class="m-l-20">
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Full Name</p>
		                    <p class="col-8 f-12">{{ $tenant->em_name ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Relation</p>
		                    <p class="col-8 f-12">{{ $tenant->em_rel ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Home Phone</p>
		                    <p class="col-8 f-12">{{ $tenant->em_contact_home ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Work Phone</p>
		                    <p class="col-8 f-12">{{ $tenant->em_contact_work ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Mobile Phone</p>
		                    <p class="col-8 f-12">{{ $tenant->em_contact_phone ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Address</p>
		                    <p class="col-8 f-12">{{ $tenant->em_address ?? '---' }}</p>
		                </div>
					</div>

					<h6 class="f-w-600 m-t-20 m-b-20">Credit Check</h6>
					<div class="m-l-20">
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Bank Name</p>
		                    <p class="col-8 f-12">{{ $tenant->bank_name ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Branch</p>
		                    <p class="col-8 f-12">{{ $tenant->bank_branch ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Credit Card (Bank Issuer)</p>
		                    <p class="col-8 f-12">{{ $tenant->cc_card ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">Government ID</p>
		                    <p class="col-8 f-12">{{ $tenant->gov_id ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">CCT (Cedula) #</p>
		                    <p class="col-8 f-12">{{ $tenant->cct_no ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">CCT Location Issued</p>
		                    <p class="col-8 f-12">{{ $tenant->cct_location ?? '---' }}</p>
		                </div>
						<div class="row">
		                	<p class="col-3 f-12 p-r-0">CCT Date Issued</p>
		                    <p class="col-8 f-12">{{ $tenant->cct_date ?? '---' }}</p>
		                </div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection