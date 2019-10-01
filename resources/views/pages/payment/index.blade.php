@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Payments';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('payment') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Payments</h5>
            <div class="card-header-right">
            <a href="{{ route('payment.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Property">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($payments) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>REF NO</th>
                                <th>Payment Type</th>
                                {{-- <th>Tenant</th>
                                <th>Unit</th> --}}
                                <th>Amount</th>
                                <th>File</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('payment.show', $payment->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $payment->slug }}
                                        </a>
                                    </td>
                                <td style="font-size: 13px;">{{ $payment->reference_no }}</td>
                                <td style="font-size: 13px;">{{ $payment->payment_type->name }}</td>
                                {{-- <td style="font-size: 13px;">{{ $payment->tenant->user->fullnamew }}</td>
                                <td style="font-size: 13px;">{{ $payment->unit_total }}</td> --}}
                                <td style="font-size: 13px;">{{ $payment->amount_peso }}</td>
                                <td style="font-size: 13px;"><img src="{{ Storage::url($payment->file) }}" height="30px" width="30px" /></td>
                                <td style="font-size: 13px;">{{ $payment->created_at }}</td>
                                <td style="font-size: 13px;">
                                    <a href="{{ route('payment.edit', $payment->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="{{ route('payment.destroy', $payment->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                        <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>REF NO</th>
                                <th>Payment Type</th>
                                {{-- <th>Tenant</th>
                                <th>Unit</th> --}}
                                <th>Amount</th>
                                <th>File</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                <small>You have no available payments <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection
