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
use App\Rent;
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
            'middlename' => 'max:266',
            'contact' => 'max:266',
            'address' => 'max:266',
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
            ]);
            Alert::success('Tenant '.$user_store->lastname.", ".$user_store->firstname." ".$user_store->middlename." created",'Success')->autoclose(2800);
            return redirect()->route('tenant.show', $user_store->slug);
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
        return view('pages.user.tenant.show', compact('tenant', 'leases', 'payables'));
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
