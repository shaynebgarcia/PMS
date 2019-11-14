<?php

namespace App\Http\Controllers;

use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Billing;

use Carbon\Carbon;
use Alert;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $leasing_agreements = LeasingAgreement::all();
        $leasing_agreement_details = LeasingAgreementDetail::all();
        $billings = Billing::all();
        $now = Carbon::now();
        return view('welcome', compact('leasing_agreements', 'leasing_agreement_details', 'billings', 'now'));
    }
}
