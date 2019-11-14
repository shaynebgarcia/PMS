<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-4">
			<div class="page-header-title">
			<i class="feather {{ $breadcrumb_icon ?? 'icon-home' }} bg-c-blue"></i>
				<div class="d-inline">
				<h5>{{ $breadcrumb_title ?? 'Title' }}</h5>
				<span>{{ $breadcrumb_subtitle ?? '' }}</span>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="page-header-breadcrumb">
				@yield('breadcrumbs')
				{{-- <ul class=" breadcrumb breadcrumb-title">
					<li class="breadcrumb-item">
						<a href="index.html"><i class="feather icon-home"></i></a>
					</li>
					<li class="breadcrumb-item">
						<a href="#!">Dashboard</a> </li>
					</ul> --}}
			</div>
		</div>
	</div>
</div>