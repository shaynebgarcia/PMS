@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.select-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Payment Form';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('payment-create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Payment Form</h5>
                </div>
                <div class="card-block">
                    <form id="create-payment" method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                        @CSRF
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Tenant</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <select class="select2" name="tenant" style="width: 100%">
                                        <option value="#" disabled selected>Select Tenant</option>
                                        @foreach($tenants as $tenant)
                                            <option value="{{ $tenant->id }}">{{ $tenant->user->fullnamewm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Payment Type</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <select class="select2" name="payment_type" style="width: 100%">
                                        <option value="#" disabled selected>Select Payment Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_type')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Amount</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text">{{ config('pms.ph_currency.sign') }}</label>
                                        </span>
                                        <input type="number" class="form-control" name="amount" value="">
                                    </div>
                                    @error('amount')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Reference No</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="text" class="form-control" name="reference_no" value="">
                                    @error('reference_no')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Supporting File</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="file" class="form-control" name="payment_file">
                                    @error('payment_file')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Note</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <textarea rows="5" cols="5" class="form-control" name="note" value=""></textarea>
                                    @error('note')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
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

@section('js-plugin')
    @include('includes.plugins.select-js')
@endsection