@extends('layouts.admindek')

@section('css-plugin')
	@include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.bill.icon');
        $breadcrumb_title = config('pms.breadcrumbs.bill.bill-group.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.bill.bill-group.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease-bill', $property, $lease_detail) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
	</div>
</div>
@endsection

@section('js-plugin')
	@include('includes.plugins.select-js')
@endsection