<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\LeasingAgreement;
use App\LeasingPayable;
use App\Tenant;
use App\User;
use App\Unit;
use App\Billing;
use Alert;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereIn('role_id', [4,5,6])->get();
        $tenants = Tenant::all();

        return view('pages.user.tenant.index', compact('users', 'tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'middlename' => 'max:255',
            'contact' => 'max:255',

            'address' => 'max:255',
            'address_tel' => 'max:255',
            'address2' => 'max:255',
            'address2_tel' => 'max:255',
            'address3' => 'max:255',
            'address3_tel' => 'max:255',

            'birthdate' => 'max:255',
            'birthplace' => 'max:255',
            'age' => 'max:255',
            'occupation' => 'max:255',

            'emp_name' => 'max:255',
            'office_address' => 'max:255',
            'office_tel' => 'max:255',
            'yrs_w_employer' => 'max:255',

            'prev_emp_name' => 'max:255',
            'prev_emp_address' => 'max:255',

            'spouse_name' => 'max:255',
            'spouse_occupation' => 'max:255',
            'spouse_emp_name' => 'max:255',
            'spouse_emp_address' => 'max:255',
            'spouse_emp_tel' => 'max:255',

            'rel1_name' => 'max:255',
            'rel1_occupation' => 'max:255',
            'rel1_emp_name' => 'max:255',
            'rel1_emp_address' => 'max:255',
            'rel1_emp_tel' => 'max:255',

            'rel2_name' => 'max:255',
            'rel2_occupation' => 'max:255',
            'rel2_emp_name' => 'max:255',
            'rel2_emp_address' => 'max:255',
            'rel2_emp_tel' => 'max:255',

            'em_name' => 'max:255',
            'em_rel' => 'max:255',
            'em_contact_home' => 'max:255',
            'em_contact_work' => 'max:255',
            'em_contact_phone' => 'max:255',
            'em_address' => 'max:255',

            'college_uni' => 'max:255',
            'college_yr' => 'max:255',
            'college_course' => 'max:255',
            'hs_name' => 'max:255',
            'hs_yr' => 'max:255',
            'gs_name' => 'max:255',
            'gs_yr' => 'max:255',
            'masters' => 'max:255',

            'bank_name' => 'max:255',
            'bank_branch' => 'max:255',
            'cc_card' => 'max:255',
            'gov_id' => 'max:255',
            'cct_no' => 'max:255',
            'cct_location' => 'max:255',
            'cct_date' => 'max:255',

            'survey_question' => 'max:255',
        ]);

        $user_store = User::create([
            'role_id' => 4,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
        ]);

        $user_store->update(['slug' => Str::slug($request->lastname.' '.$request->firstname.' '.$user_store->id, '-')]);

        if (!$user_store) {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('tenant.create');
        } else {
            $tenant_store = Tenant::create([
                'user_id' => $user_store->id,
                'contact' => $request->contact,
                'address' => $request->address,
                'address_tel' => $request->address_tel,
                'address2' => $request->address2,
                'address2_tel' => $request->address2_tel,
                'address3' => $request->address3,
                'address3_tel' => $request->address3_tel,
                'birthdate' => $request->address,
                'birthplace' => $request->address,
                'age' => $request->address,
                'occupation' => $request->occupation,
                'emp_name' => $request->emp_name,
                'office_address' => $request->office_address,
                'office_tel' => $request->office_tel,
                'yrs_w_employer' => $request->yrs_w_employer,
                'prev_emp_name' => $request->prev_emp_name,
                'prev_emp_address' => $request->prev_emp_address,

                'spouse_name' => $request->spouse_name,
                'spouse_occupation' => $request->spouse_occupation,
                'spouse_emp_name' => $request->spouse_emp_name,
                'spouse_emp_address' => $request->spouse_emp_address,
                'spouse_emp_tel' => $request->spouse_emp_tel,

                'rel1_name' => $request->rel1_name,
                'rel1_occupation' => $request->rel1_occupation,
                'rel1_emp_name' => $request->rel1_emp_name,
                'rel1_emp_address' => $request->rel1_emp_address,
                'rel1_emp_tel' => $request->rel1_emp_tel,

                'rel2_name' => $request->rel2_name,
                'rel2_occupation' => $request->rel2_occupation,
                'rel2_emp_name' => $request->rel2_emp_name,
                'rel2_emp_address' => $request->rel2_emp_address,
                'rel2_emp_tel' => $request->rel2_emp_tel,

                'em_name' => $request->em_name,
                'em_rel' => $request->em_rel,
                'em_contact_home' => $request->em_contact_home,
                'em_contact_work' => $request->em_contact_work,
                'em_contact_phone' => $request->em_contact_phone,
                'em_address' => $request->em_address,

                'college_uni' => $request->college_uni,
                'college_yr' => $request->college_yr,
                'college_course' => $request->college_course,
                'hs_name' => $request->hs_name,
                'hs_yr' => $request->hs_yr,
                'gs_name' => $request->gs_name,
                'gs_yr' => $request->gs_yr,
                'masters' => $request->masters,

                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'cc_card' => $request->cc_card,
                'gov_id' => $request->gov_id,
                'cct_no' => $request->cct_no,
                'cct_location' => $request->cct_location,
                'cct_date' => $request->cct_date,

                'survey_question' => $request->survey_question,

            ]);
            Alert::success('Tenant '.$user_store->lastname.", ".$user_store->firstname." ".$user_store->middlename." created",'Success')->autoclose(2800);

            return redirect()->route('tenant.show', $user_store->slug)->with('assign', 'Do you want to create a leasing agreement and assign this new tenant to a unit? <a href="/lease/create">Click Here</a>');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $tenant = Tenant::where('user_id', $user->id)->first();
        $leases = LeasingAgreement::where('tenant_id', $tenant->id)->get();
        $payables = LeasingPayable::all();
        $bills = Billing::all();
        return view('pages.user.tenant.show', compact('tenant', 'leases', 'payables', 'bills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
    }

        // GET | Assigning tenant to a unit
    public function rentform(Tenant $tenant)
    {
        $units = Unit::where('status', 'Vacant')->get();
        return view('pages.user.tenant.rent-form', compact('tenant', 'units'));
    }

}
