@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.lease.icon');
        $breadcrumb_title = config('pms.breadcrumbs.lease.lease-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.lease.lease-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('lease') }}
@endsection

@section('content')
@endsection

@section('js-plugin')
@include('includes.plugins.datatable-js')
@endsection