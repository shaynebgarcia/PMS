@extends('layouts.admindek', ['pageSlug' => 'service-create'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.datatable-css')
    {{-- @include('includes.plugins.chart-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.service.icon');
        $breadcrumb_title = config('pms.breadcrumbs.service.service-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.service.service-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('service-create', $property) }}
@endsection

@section('content')
    <!-- <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12">
	    	<div class="alert alert-warning icons-alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<i class="icofont icofont-close-line-circled"></i>
				</button>
				<p><strong>Renewing will mark the current/previous agreement as EXPIRED.</strong></p>
			</div>
		</div>
	</div> -->
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<form id="services-store" method="POST" action="{{ route('services.store') }}">
	        @CSRF
		        <div class="row">
		        	<div class="col-lg-12 col-md-12 col-sm-12">
			            <div class="card">
			                <div class="card-header">
			                    <h5>Leasing Agreement</h5>
			                </div>
			                <div class="card-block">
			                    <div class="form-group row">
			                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Leasing Agreement</label>
			                            <div class="col-lg-9 col-md-9 col-sm-9">
			                                <select class="select2" name="agreement" style="width: 100%">
			                                    <option value="#" disabled selected>Select an agreement</option>
			                                        @foreach($leases as $lease)
			                                            <option value="{{ $lease->details->last()->id }}">
			                                                {{ $lease->details->last()->agreement_no }} | {{ $lease->unit->number }} | @foreach($lease->tenant_list as $tl)
			                                                    {{ $tl->tenant->user->lnamefname }},
			                                                    @if ($loop->last)
			                                                        {{ $tl->tenant->user->lnamefname }}
			                                                    @endif
			                                                @endforeach
			                                            </option>
			                                        @endforeach
			                                </select>
			                            </div>
			                    </div>
			                </div>
			            </div>
		        	</div>
		        </div>

	            {{-- SELECT TABLE Subscription Services --}}
	            @include('pages.service.service-subscriptions.subscription-multibox')


                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.formmasking-js')
    @include('includes.plugins.formpicker-js')
    @include('includes.custom-scripts.multi-subscriptions')
@endsection

