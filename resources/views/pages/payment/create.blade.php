@extends('layouts.admindek', ['pageSlug' => 'payment-create'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.fileupload-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.payment.icon');
        $breadcrumb_title = config('pms.breadcrumbs.payment.payment-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.payment.payment-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('payment-create') }}
@endsection

@section('content')
    <form id="create-payment" method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
        @CSRF
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Payment Form</h5>
                    </div>
                    <div class="card-block">
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
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Amount Due</label>
                                <div class="col-lg-4 col-md-10 col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
                                        </span>
                                        <input type="number" step="0.01" class="form-control" name="amount_due" value="">
                                    </div>
                                    @error('amount_due')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Amount Paid</label>
                                <div class="col-lg-4 col-md-10 col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
                                        </span>
                                        <input type="number" step="0.01" class="form-control" name="amount_paid" value="">
                                    </div>
                                    @error('amount_paid')
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
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Date of Payment</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="date" class="form-control" name="date_payment" value="">
                                    @error('date_payment')
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Attach Payment</h5>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Lease Agreement</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <select class="select2" name="agreement" style="width: 100%">
                                        <option value="#" disabled selected>Select an Agreement</option>
                                        @foreach($lease_details as $lease)
                                            <option value="{{ $lease->id }}">{{ $lease->agreement_no }} | {{ $lease->agreement->unit->property->name }} - {{ $lease->agreement->unit->number }} | {{ $lease->agreement->tenant->user->fullnamewm }} | {{ $lease->term_start}} ({{ $lease->status}})</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Payment to Invoice</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <select class="select2" name="bill" id="bill" style="width: 100%">
                                        <option value="#" disabled selected>Select a Billing Invoice</option>
                                        @foreach($bills as $bill)
                                            <option value="{{ $bill->id }}">{{ $bill->invoice_no }} | {{ $bill->monthyear }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-block">
                    <div action="#" class="dropzone">
                    <div class="fallback">
                    <input name="file" type="file" multiple />
                    </div>
                    </div>
                    <div class="text-center m-t-20">
                    <button class="btn btn-primary">Upload Now</button>
                    </div>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.fileupload-js')
    <script type='text/javascript'>
        $(document).ready(function() {
            // $('#bill').attr('disabled','disabled'); 
            $('select[name="payment_type"]').on('change',function(){
            var bill = $(this).val();
                if(bill == 1){           
                    $('#bill').removeAttr('disabled');          
                 }else{
                    $('#bill').attr('disabled','disabled'); 
                }  
              });
        });
    </script>
@endsection