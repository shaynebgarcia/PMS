@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Leasing Payables Form';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Leasing Payables Form</h5>
            </div>
            <div class="card-block">
                <form id="create-payable" method="POST" action="{{ route('payable.store', $lease->id) }}">
                    @CSRF
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Property/Unit</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h5>{{ $lease->unit->property->name }} {{ $lease->unit->number }}</h5>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Tenant</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h6>{{ $lease->tenant->user->fullnamewm }}</h6>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date of Contract</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h6>{{ date('M d, Y', strtotime($lease->date_of_contract)) }}</h6>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Payable</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select class="select2" name="payable_type" style="width: 100%">
                                    <option value="#" disabled selected>Select Payable</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Amount</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="number" class="form-control" name="amount" value="">
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                            <button type="submit" class="btn waves-effect waves-light btn-info btn-round">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

