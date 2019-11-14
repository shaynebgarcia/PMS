<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Invoice {{ $date_generated }}</title>

        <style>
            @font-face {
              font-family: 'Open Sans';
              src: url('07ffedf4983a20afacaf57bfba0ebf45.ttf') format('truetype');
            }
            body{
                font-family: 'Open Sans';
                width: 100%;  
            }
            .invoice {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 12px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice table {
                width: 100%;
                text-align: left;
            }
            .invoice table td {
                padding: 5px;
                vertical-align: top;
            }
            
            .invoice table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice table th {
                width: 100%;
                border-bottom: 2px solid #dee2e6;
                vertical-align: bottom;
                font-size: small;
                text-transform: uppercase;
            }

            .invoice table tr.top table td {
                padding-bottom: 10px;
            }
            
            .invoice table tr.top table td.title {
                font-size: 30px;
                line-height: 45px;
                color: #333;
            }
            .invoice table tr.top table td.top-info {
                font-size: 14px;
                line-height: 20px;
                color: #333;
            }
            .invoice table tr.information table td {
                /*text-transform: uppercase;*/
                padding-bottom: 20px;
            }
            .invoice table tr.information2 table td {
                /*text-transform: uppercase;*/
                padding-bottom: 0px;
            }
            .invoice table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
                margin-top: 40px;
            }
            .invoice table tr.details td {
                padding-bottom: 20px;
            }
            
            .invoice table tr.item td{
                padding: 0 10px;
                font-size: 12px;
                border-bottom: 1px solid #eee;
            }
            
            .invoice table tr.item.last td {
                border-bottom: none;
            }

            .invoice table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

        </style>
    </head>
    <body>
        <div class="invoice">
            <table>
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="https://www.sparksuite.com/images/logo.png" style="width:200px;">
                                </td>
                                <td class="top-info">
                                    <span style="color: #aeaeae; text-transform: uppercase;">Tenant's Copy</span><br>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Billing Invoice: {{ $invoice->invoice_no }}<br>
                                    Rental Due Date: {{ date('m/d/Y', strtotime($invoice->due_date )) }}<br>
                                    Name of Tenant: {{ $invoice->leasing_agreement_details->agreement->tenant->user->fullnamewm }}<br>
                                    Property/Unit NO: {{ $invoice->leasing_agreement_details->agreement->unit->property->name }} - {{ $invoice->leasing_agreement_details->agreement->unit->number }}<br>
                                </td>
                                <td>
                                    Billing Date: {{ date('m/d/Y', strtotime($invoice->billing_date )) }} <br>
                                    <span style="text-transform: uppercase;">{{ $invoice->monthyear }}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Previous Bill
                    </td>
                    <td>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Previous Billing Amount Due
                    </td>
                    <td>
                        0.00 PHP
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Previous Billing Amount Paid
                    </td>
                    <td>
                        0.00 PHP
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Over/Under-payment
                    </td>
                    <td>
                        0.00 PHP
                    </td>
                </tr>
                <br>
                <tr class="heading">
                    <td>
                        Current Charges
                    </td>
                    <td>
                    </td>
                </tr>
                @foreach($invoice->details as $item)
                    <tr class="item">
                        <td>
                            {{ $item->description }}
                        </td>
                        <td>
                            {{ $item->amount_currency_code }}
                        </td>
                    </tr>
                @endforeach
                <tr class="heading">
                    <td>
                        Other Charges
                    </td>
                    <td>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        LESS OVER-PAYMENT/PLUS UNDER-PAYMENT
                    </td>
                    <td>
                        0.00 PHP
                    </td>
                </tr>
                <tr class="total">
                    <td>
                    </td>
                    <td>
                        {{ number_format($invoice->total_amount_due, 2)." ".config('pms.currency.code') }}
                    </td>
                </tr>
                <tr class="information2" style="padding-bottom: 0;">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Prepared By: {{ $invoice->prepared_by }}<br>
                                </td>
                                <td>
                                    Received By: ___________________________<br>
                                    Date: ___________________________
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information2">
                    <p>Please pay directly to BDO Bank Direct Deposit of CITYDORMS CORP. SA#6860054688. <br>
                    Always bring this notice with you when making payments. Kindly give copy of deposit slip to Bldg Caretaker. <br>
                    Please pay on or before the following date to avoid disconnection: {{ date('M d, Y', strtotime(config('pms.billing.invoice.after_due_date'), strtotime($invoice->billing_from))) }}<br>
                    Reconnection fee for cut-off facilities is P300.00 and service fee for cash payment pick-up is P300.00.</p>
                </tr>
            </table>
        </div>
    </body>
</html>