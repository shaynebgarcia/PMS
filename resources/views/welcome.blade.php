@extends('layouts.admindek', ['pageSlug' => 'dashboard'])

@section('css-plugin')
    <link rel="stylesheet" type="text/css" href="{{ asset('laravel-admindek/assets/css/font-awesome-n.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('laravel-admindek/assets/css/widget.css') }}">
    {{-- @include('includes.plugins.datatable-css') --}}
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_title = 'Dashboard';
        $breadcrumb_subtitle = 'Dashboard';
    @endphp
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    <div class="row ">
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-red">
            <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
            <h6 class="m-b-5 text-white">Total Profit</h6>
            <h3 class="m-b-0 f-w-700 text-white">$1,783</h3>
            </div>
            <div class="col-auto">
            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
            </div>
            </div>
            <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From Previous Month</p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-blue">
            <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
             <h6 class="m-b-5 text-white">Total Orders</h6>
            <h3 class="m-b-0 f-w-700 text-white">15,830</h3>
            </div>
            <div class="col-auto">
            <i class="fas fa-database text-c-blue f-18"></i>
            </div>
            </div>
            <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-green">
            <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
            <h6 class="m-b-5 text-white">Average Price</h6>
            <h3 class="m-b-0 f-w-700 text-white">$6,780</h3>
            </div>
            <div class="col-auto">
            <i class="fas fa-dollar-sign text-c-green f-18"></i>
            </div>
            </div>
            <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From Previous Month</p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-yellow">
            <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
            <h6 class="m-b-5 text-white">Product Sold</h6>
            <h3 class="m-b-0 f-w-700 text-white">6,784</h3>
            </div>
            <div class="col-auto">
            <i class="fas fa-tags text-c-yellow f-18"></i>
            </div>
            </div>
            <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p>
            </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="alert alert-primary background-primary">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
                </button>
                <strong>Hi <span class="f-w-700">{{ Auth::user()->firstname }}</span>!</strong> You are currently managing <span class="text-uppercase f-w-700">{{ $property->name }}</span>.
            </div>
        </div>
        {{-- <div class="col-md-12">
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
        </div> --}}

        <div class="col card-deck">
        {{-- <div class="col-md-12 col-xl-4"> --}}
            <div class="card card-yellow st-cir-card text-white">
                <div class="card-block">
                    <h3 class="f-w-800 m-b-10 text-right">{{ MdY($now) }}</h3>
                    <h6 class="f-w-800 m-b-10">Employee</h6>
                    <ul class="list-unstyled m-b-20">
                        @foreach($users->take(20) as $user)
                            @if(md($user->birthdate) == md($now) && $user->is_employee == 1)
                                <li class="d-inline-block">
                                    <img src="https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png" alt="user-image" class="img-radius img-40 m-r-15" data-toggle="tooltip" data-placement="top" title="{{ $user->fullnamewm }}">
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <h6 class="f-w-800 m-b-10">Tenant</h6>
                    <ul class="list-unstyled m-b-20">
                        @foreach($users->take(20) as $user)
                            @if(md($user->birthdate) == md($now) && $user->is_employee == 0)
                                <li class="d-inline-block">
                                    <img src="https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png" alt="user-image" class="img-radius img-40 m-r-15" data-toggle="tooltip" data-placement="top" title="{{ $user->fullnamewm }}">
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <span class="st-bt-lbl">TODAYS BIRTHDAYS</span>
                </div>
            </div>
        {{-- </div>
        <div class="col-xl-4 col-md-6"> --}}
            <div class="card new-cust-card">
                <div class="card-header">
                    <h5>Who's Online</h5>
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
                <div class="card-block">
                    @foreach($users->where('last_login', !null)->sortByDesc('online')->take(20) as $user)
                        <div class="align-middle m-b-25">
                            <img src="@if(Auth::user()->image_file_id == null) https://api.adorable.io/avatars/285/<?php echo rand(5, 15); ?>@adorable.png @else {{ asset(Storage::url(Auth::user()->avatar->path)) }} @endif" alt="user image" class="img-radius img-40 align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>
                                        @if(Auth::user()->id == $user->id)
                                            You
                                        @else
                                            {{ $user->fullname }}
                                        @endif
                                    </h6>
                                </a>
                                <p class="ellipsis-widget text-muted m-b-0" data-toggle="tooltip" data-placement="top" title="
                                    @if($user->online == 1)
                                        Managing
                                    @else
                                        Managed
                                    @endif
                                    {{ $user->access_property->name }} ({{ $user->access_property->code }})">
                                    @if($user->online == 1)
                                        Managing
                                    @else
                                        Managed
                                    @endif
                                    {{ $user->access_property->name }} ({{ $user->access_property->code }})
                                </p>
                                @if($user->online == 1)
                                    <span class="status active"></span>
                                @else
                                    @if($user->last_login == null)
                                        <span class="status deactive text-mute"><i class="far fa-clock m-r-5"></i>Undetectable</span>
                                    @else
                                        <span class="status deactive text-mute"><i class="far fa-clock m-r-5"></i>{{ Carbon\Carbon::parse($user->last_login)->diffForHumans() }}</span>
                                    @endif
                                    
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="col-xl-4 col-md-12"> --}}
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>What’s New</h5>
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
                    <div class="card-block">
                        <div class="scroll-widget">
                            <div class="latest-update-box">
                                @foreach($activities->where('description', 'created') as $activity)
                                    @if ($loop->first)
                                        <div class="row p-t-20 p-b-30">
                                            <div class="col-auto text-right update-meta p-r-0">
                                                <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                            </div>
                                            <div class="col p-l-5">
                                                <a href="#!"><h6 class="text-capitalize">{{ $activity->description }} {{ class_basename($activity->subject_type) }}</h6></a>
                                                <p class="text-muted m-b-0">Jonny michel</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row p-b-30">
                                        <div class="col-auto text-right update-meta p-r-0">
                                            <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                        </div>
                                        <div class="col p-l-5">
                                            <a href="#!"><h6 class="text-capitalize">{{ $activity->description }}</h6></a>
                                            <p class="text-muted m-b-0">Hemilton</p>
                                        </div>
                                    </div>
                                    @if ($loop->last)
                                    <div class="row">
                                        <div class="col-auto text-right update-meta p-r-0">
                                            <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                        </div>
                                        <div class="col p-l-5">
                                            <a href="#!"><h6>New Order Received.</h6></a>
                                            <p class="text-muted m-b-0">Hemilton</p>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                                
                                <div class="row p-b-30">
                                    <div class="col-auto text-right update-meta p-r-0">
                                        <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                    </div>
                                    <div class="col p-l-5">
                                        <a href="#!"><h6>New Order Received.</h6></a>
                                        <p class="text-muted m-b-0">Hemilton</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-right update-meta p-r-0">
                                        <img src="../files/assets/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15 update-icon">
                                    </div>
                                    <div class="col p-l-5">
                                        <a href="#!"><h6>Your Manager Posted.</h6></a>
                                        <p class="text-muted m-b-0">Jonny michel</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-right update-meta p-r-0">
                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                    </div>
                                    <div class="col p-l-5">
                                        <a href="#!"><h6>You have 3 pending Task.</h6></a>
                                        <p class="text-muted m-b-0">Hemilton</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
        {{-- <div class="col-xl-4 col-md-6">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>Latest Activity</h5>
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
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            @foreach($activities->where('description', !'created') as $activity)
                                @if ($loop->first)
                                    <div class="row p-t-20 p-b-30">
                                        <div class="col-auto text-right update-meta p-r-0">
                                            <i class="b-primary update-icon ring"></i>
                                        </div>
                                        <div class="col p-l-5">
                                            <a href="#!">
                                                <h6 class="text-capitalize">{{ $activity->description }}</h6>
                                            </a>
                                            <p class="text-muted m-b-0">
                                                <span class="text-capitalize">{{ $activity->description }}</span> by 
                                                <a href="#!" class="text-c-blue">
                                                    {{ $activity->description }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row p-b-30">
                                    <div class="col-auto text-right update-meta p-r-0">
                                        <i class="b-primary update-icon ring"></i>
                                    </div>
                                    <div class="col p-l-5">
                                        <a href="#!"><h6>{{ $activity->description }}</h6></a>
                                        <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                    </div>
                                </div>
                                @if ($loop->last)
                                    <div class="row">
                                        <div class="col-auto text-right update-meta p-r-0">
                                            <i class="b-success update-icon ring"></i>
                                        </div>
                                        <div class="col p-l-5">
                                            <a href="#!"><h6>{{ $activity->description }}</h6></a>
                                            <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            
                            
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-success update-icon ring"></i>
                                </div>
                                <div class="col p-l-5">
                                    <a href="#!"><h6>Miscellaneous</h6></a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                </div>
                            </div>
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-danger update-icon ring"></i>
                                </div>
                                <div class="col p-l-5">
                                    <a href="#!"><h6>Your Manager Posted.</h6></a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
                                </div>
                            </div>
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-primary update-icon ring"></i>
                                </div>
                                <div class="col p-l-5">
                                    <a href="#!"><h6>Showcases</h6></a>
                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
    </div>
@endsection

@section('js-plugin')
    <script type="text/javascript" src="{{ asset('laravel-admindek/assets/pages/dashboard/custom-dashboard.js') }}"></script>
    {{-- @include('includes.plugins.datatable-js') --}}
@endsection