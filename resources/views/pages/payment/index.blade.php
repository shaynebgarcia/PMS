@extends('layouts.admindek', ['pageSlug' => 'payment-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
    <style>
        #payment_file {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
        }
        #payment_file:hover {opacity: 0.7;}
        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          /*z-index: 0;*/ /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
          margin: auto;
          display: block;
          width: 80%;
          max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
          margin: auto;
          display: block;
          width: 80%;
          max-width: 700px;
          text-align: center;
          color: #ccc;
          padding: 10px 0;
          height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {  
          -webkit-animation-name: zoom;
          -webkit-animation-duration: 0.6s;
          animation-name: zoom;
          animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
          from {-webkit-transform:scale(0)} 
          to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
          from {transform:scale(0)} 
          to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #f1f1f1;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
        }

        .close:hover,
        .close:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
          .modal-content {
            width: 100%;
          }
        }
        </style>
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.payment.icon');
        $breadcrumb_title = config('pms.breadcrumbs.payment.payment-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.payment.payment-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('payment') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Payments</h5>
            <div class="card-header-right">
              @can('Create Property')
                <a href="{{ route('payment.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Payment">
                    <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                        <i class="fa fa-plus fa-sm" style="color: white;"></i>
                    </button>
                </a>
              @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($payments) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive wrap">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Agreement</th>
                                <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Unit</th>
                                <th class="{{ config('pms.table.th.font-size') }} bg-highlight">Tenant</th>
                                <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                <th class="{{ config('pms.table.th.font-size') }}">REF NO</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Payment Type</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Invoice</th>
                                {{-- <th>Tenant</th>
                                <th>Unit</th> --}}
                                <th class="{{ config('pms.table.th.font-size') }}">Date Paid</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Amount Due</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Amount Paid</th>
                                <th class="{{ config('pms.table.th.font-size') }}">File</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                @php
                                    $diff_percent = ($payment->amount_paid / $payment->amount_due) * 100 - 100;
                                    if ($payment->amount_due <= $payment->amount_paid) {
                                        $color = 'text-c-green';
                                        $text = '+'.round($diff_percent, 2).'%';
                                    } else {
                                        $color = 'text-c-red';
                                        $text = round($diff_percent, 2).'%';
                                    }
                                    // Check if there is attached agreement
                                    if ($payment->leasing_agreement_details_id != null) {
                                        $property_id_payment = $payment->agreement_detail->agreement->unit->property->id;
                                        // Check if there is existing access
                                        $access = $property_access->where('property_id', $property_id_payment)->where('user_id', auth()->user()->id)->first();
                                        $access_count = count($property_access->where('property_id', $property_id_payment)->where('user_id', auth()->user()->id));
                                        if ($access_count > 0) {
                                            $check = true;
                                        } else {
                                            $check = false;
                                        }
                                    }
                                @endphp
                                @if($payment->leasing_agreement_details_id != null)
                                    @if($check === true)
                                        @if ( $access->property_id != $property_id_payment)
                                            @break
                                        @endif
                                    @else
                                        @continue
                                    @endif
                                @endif
                                <tr @if($payment->leasing_agreement_details_id == null) style="background-color: #f9e596" @endif>

                                    <td class="{{ config('pms.table.td.font-size') }} bg-highlight" @if($payment->leasing_agreement_details_id != null) data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="Unit: {{ $payment->agreement_detail->agreement->unit->number }}" @endif>
                                        @if($payment->leasing_agreement_details_id == null)
                                            <span class="text-danger f-w-700 f-10">PAYMENT <br>NOT ATTACHED</span>
                                        @else
                                        {{ $payment->agreement_detail->agreement_no }}
                                        @endif
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                      {{ $payment->agreement_detail->agreement->unit->number }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }} bg-highlight">
                                        @foreach($payment->agreement_detail->agreement->tenant_list as $tl)
                                            {{ $tl->tenant->user->lnamefname }}<br>
                                        @endforeach
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      <a class="f-12 f-w-700" href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                        {{ $payment->payment_no }}
                                      </a>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $payment->reference_no }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $payment->payment_type->name }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      @if($payment->billing_id != null)
                                        <a href=""><label class="badge badge-md badge-inverse-info">{{ $payment->bill->invoice_no }}</label></a>
                                      @else
                                        NA
                                      @endif
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ dMY($payment->date_paid) }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $payment->amount_due_currency_sign }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $payment->amount_paid_currency_sign }}
                                        <span class="{{ $color }} f-w-700 m-l-10" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="%">{{ $text }}</span>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @php
                                            $file_db = $files->where('id', $payment->file_id)->first();
                                        @endphp
                                        <img id="payment_file" alt="Deposit Slip" src="http://localhost:8000/storage/payments/blank_deposit_slip1_1574840631.png" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen();" height="30px" width="30px" />
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $payment->created_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        @can('Update Payment')
                                            <a href="{{ route('payment.edit', $payment->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                            </a>
                                        @endcan
                                         @can('Delete Payment')
                                            <a href="{{ route('payment.destroy', $payment->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                                <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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

    <!-- The Modal -->
    <div id="payment_modal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("payment_modal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("payment_file");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){

          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
    </script>
@endsection
