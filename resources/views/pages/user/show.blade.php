@extends('layouts.admindek')

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = $user->fullnamewm; 
		$breadcrumb_subtitle = config('pms.breadcrumbs.user.user-show.subtitle');
    @endphp
    {{ Breadcrumbs::render('user-show', $user) }}
@endsection

@section('content')
<div class="row">
	<div class="col-4 col-4">
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
							<img src="@if($user->image_file_id == null) https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png @else {{ $user->image_file_id }} @endif"  class="img-radius img-100" alt="user.png" style="margin:0 30% 0 30%;">
			                <div class="row mt-4">
			                	<p class="col-sm-4 f-14 p-r-0">Username</p>
			                    <p class="col-sm-8 f-14">{{ $user->username }}</p>
			                </div>
			                <div class="row">
			                	<p class="col-sm-4 f-14 p-r-0">Email</p>
			                    <p class="col-sm-8 f-14">{{ $user->email }}</p>
			                </div>
			                <div class="row">
			                	<p class="col-sm-4 f-14 p-r-0">Role</p>
			                    <p class="col-sm-8 f-14">{{ $user->role->title }}</p>
			                </div>
			                <div class="row">
			                	<p class="col-sm-4 f-14 p-r-0">Property Assigned</p>
			                	@if(count($access->where('user_id', $user->id)) > 0)
			                		<p class="col-sm-8 f-14">
				                	@foreach($access->where('user_id', $user->id) as $has_access)
				                		<a href="{{ route('property.show', $has_access->property->id) }}" title="">{{ $has_access->property->name }}</a><br>
	                                @endforeach
	                            	</p>
                                @else
                                    <p class="col-sm-8 f-12">No Assigned</p>
                                @endif
			                </div>
			                @if(Auth::user()->id == $user->id)
				                <div class="row">
				                	<a href="#" class="btn waves-effect waves-light btn-primary p-0 btn-block"><i class="icofont icofont-life-buoy"></i><span class="f-12">Change Password</span></a>
				                </div>
			                @endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-8 col-8 p-0">
		<div class="col-12">
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