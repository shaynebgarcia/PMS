@extends('layouts.admindek')

{{-- @section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection --}}

@section('breadcrumbs')
    @php
        $breadcrumb_title = 'Dashboard';
        $breadcrumb_subtitle = 'Dashboard';
    @endphp
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    <div class="row">
        {{-- <div class="col-md-12 col-xl-8">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Deals Analytics</h5>
                </div>
                <div class="card-block">
                    <div id="sales-analytics" class="chart-shadow" style="height:380px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4">
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-25">Impressions</h6>
                            <h3 class="f-w-700 text-c-blue">1,563</h3>
                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye bg-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-25">Goal</h6>
                            <h3 class="f-w-700 text-c-green">30,564</h3>
                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullseye bg-c-green"></i>
                        </div>S
                    </div>
                </div>
            </div>
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-25">Impact</h6>
                            <h3 class="f-w-700 text-c-yellow">42.6%</h3>
                            <p class="m-b-0">May 23 - June 01 (2017)</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-paper bg-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card proj-progress-card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <h6>Published Project</h6>
                            <h5 class="m-b-30 f-w-700">532<span class="text-c-green m-l-10">+1.69%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-red" style="width:25%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Completed Task</h6>
                            <h5 class="m-b-30 f-w-700">4,569<span class="text-c-red m-l-10">-0.5%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:65%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Successfull Task</h6>
                            <h5 class="m-b-30 f-w-700">89%<span class="text-c-green m-l-10">+0.99%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-green" style="width:85%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Ongoing Project</h6>
                            <h5 class="m-b-30 f-w-700">365<span class="text-c-green m-l-10">+0.35%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-yellow" style="width:45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Rental Due Date Reminder</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                            <li><i class="feather icon-trash close-card"></i></li>
                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block p-b-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th class="f-14">Tenant</th>
                                    <th class="f-14">Property/Unit</th>
                                    <th class="f-14">Month</th>
                                    <th class="f-14">Rental Due Date</th>
                                    <th class="f-14">To Bill In</th>
                                    <th class="f-14">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leasing_agreements as $lease)
                                @php
                                    $latest_agreement = $leasing_agreement_details->where('leasing_agreement_id', $lease->id)->last();
                                    $last_bill = $billings->where('leasing_agreement_details_id', $latest_agreement->id)->last();
                                    $bill_month_now = $now->format('MY');
                                    $bill_month_next = date('MY', strtotime('+1 month', strtotime($latest_agreement->first_day)));
                                    if ($last_bill != null) {
                                        $next_bill_due = date('MY', strtotime('-7 day', strtotime($last_bill->billing_to)));
                                        // $bill_next_month = date('MY', strtotime('+1 month', strtotime($last_bill->monthyear)));
                                        if ($last_bill->billing_to != $now) {
                                            $bill_this = $bill_month_next;
                                        } else {
                                            $bill_this = $next_bill_due;
                                        }
                                    } else {
                                        $bill_this = $bill_month_next;
                                    }
                                    $billing_my = date('MY', strtotime($bill_this));
                                    $bill_from = $latest_agreement->bill_from($billing_my);
                                    $bill_to = $latest_agreement->bill_to($bill_from);
                                    $bill_due = $latest_agreement->bill_due($bill_from);
                                @endphp
                                    <tr>
                                        <td class="f-14">{{ $lease->tenant->user->fullnamewm }}</td>
                                        <td class="f-14">{{ $lease->unit->property->name }} - {{ $lease->unit->number }}</td>
                                        <td class="f-14">{{ date('F Y', strtotime($bill_this)) }}</td>
                                        <td class="f-14">{{ $bill_due }}</td>
                                        <td class="f-14">{{ \Carbon\Carbon::createFromTimeStamp(strtotime('-7 day', strtotime($bill_due)))->diffForHumans() }}</td>
                                        <td class="f-14">
                                            <a class="f-14" href="
                                            {{ route('billing.display',
                                            [   $lease->unit->property->id,
                                                $lease->id,
                                                $latest_agreement->id,
                                                $bill_this
                                            ])}}" title="">
                                                Generate Bill
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection --}}