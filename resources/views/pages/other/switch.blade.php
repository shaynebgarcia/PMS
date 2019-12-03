@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_title = 'Switch Properties';
        $breadcrumb_subtitle = 'Lists all properties that are accessible';
    @endphp
    {{ Breadcrumbs::render('switch') }}
@endsection

@section('content')
<form id="switch-property" method="POST" action="{{ route('property.regen') }}">
    @CSRF
    <div class="row">
        <div class="col-md-12">
            @php
                print_r(Session::all());
            @endphp
        </div>
        <div class="col-md-12">

            {{-- <div class="alert alert-primary background-primary">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
                </button>
                <strong>Hi <span class="f-w-700">{{ Auth::user()->firstname }}</span>!</strong> You are currently managing <span class="text-uppercase f-w-700">{{ $property->name }}</span>.
            </div> --}}
            <div class="card table-card">
                <div class="card-header">
                    <h5>Select Property</h5>
                </div>
                <div class="card-block p-b-0">
                    <div class="form-group row">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Select Property</label>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select class="select2" id="new_selected_property_id" style="width: 100%">
                                    <option value="#" disabled selected>Select Property</option>
                                        @foreach($property_access as $p)
                                            <option value="{{ $p->property_id }}">
                                                {{ $p->property->name }} ({{ $p->property->code }})
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <button type="submit" class="btn btn-primary btn-sm">Switch</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection