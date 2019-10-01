@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = $user->fullnamewm;
            $breadcrumb_subtitle = ucfirst($user->role->title); ?>
    {{ Breadcrumbs::render('user-show', $user) }}
@endsection

@section('content')
<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div id="navigation">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header borderless">
							<h5>{{ $user->fullnamewm }}</h5>
							<div class="card-header-right">
							<i class="icofont icofont-navigation-menu"></i>
							</div>
						</div>
						<div class="card-block">
			                <div class="row mt-2">
			                	<p class="col-sm-4 f-12 p-r-0">Contact</p>
			                    <p class="col-sm-8 f-12">{{ $user->contact }}</p>
			                </div>
			                <div class="row">
			                	<p class="col-sm-4 f-12 p-r-0">Email</p>
			                    <p class="col-sm-8 f-12">{{ $user->email }}</p>
			                </div>
			                @if(Auth::user()->id == $user->id)
				                <div class="row">
				                	<a href="#" class="btn waves-effect waves-light btn-primary p-0 btn-block"><i class="icofont icofont-life-buoy"></i><span class="f-12">Change Password</span></a>
				                </div>
			                @endif
							{{-- <div class="support-btn">
								<a href="#!" class="btn waves-effect waves-light btn-primary btn-block"><i class="icofont icofont-life-buoy"></i> Item support</a>
							</div> --}}
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
						<h4>Activity</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection