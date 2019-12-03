<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyAccess;
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
    public function __construct(Request $request)
    {
        $this->property = $request->session()->get('property_id');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $property = Property::findorFail($this->property);
        $leasing_agreements = LeasingAgreement::all();
        $leasing_agreement_details = LeasingAgreementDetail::all();
        $billings = Billing::all();
        $now = Carbon::now();
        return view('welcome', compact('property', 'leasing_agreements', 'leasing_agreement_details', 'billings', 'now'));
    }

    public function switch()
    {
        $property = Property::findorFail($this->property);
        $property_access = PropertyAccess::where('user_id', auth()->user()->id)->get();
        $now = Carbon::now();
        return view('pages.other.switch', compact('property', 'property_access', 'now'));
    }

    public function regen(Request $request)
    {
        $request->validate([
            'new_selected_property_id' => 'required',
        ]);

        $value = $request->session()->pull('property_id');
        
        $request->session()->put('property_id', $request->new_selected_property_id);
        // $request->session()->regenerate();

        dd($value);
        return redirect()->back();
    }

}
