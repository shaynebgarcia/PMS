<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Property;
use App\PropertyAccess;

use Carbon\Carbon;
use Alert;

class UserController extends Controller
{

    public function __construct(Request $request)
    {
        $this->property = session()->get('property_id');
    }

    public function rules()
    {
        return [
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'middlename' => 'max:255',
            'birthdate' => 'date',
            'username' => 'required|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email' ,
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|string|min:6|same:password',
            'role' => 'required',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Property::findorFail($this->property);
        $users = User::all();
        $access = PropertyAccess::all();
        return view('pages.user.index', compact('property', 'users', 'access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::findorFail($this->property);
        $properties = Property::all();
        $roles = Role::all();
        return view('pages.user.create', compact('properties', 'property', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        // Creating user
        $user_stored = User::create([
            'is_employee' => 1,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'birthdate' => $request->birthdate,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user_stored) {

            $user_stored->update([
                'user_no' => config('pms.unique_prefix.user').$user_stored->id,
            ]);
            $user_stored->assignRole($request->role);

            if(count($request->properties)>0) {
                foreach($request->properties as $item => $v) {
                    // Create each property assignment
                    $array = array (
                        'user_id' => $user_stored->id,
                        'property_id' => $request->properties[$item],
                    );
                    $assigned_to = PropertyAccess::insert($array);
                }
            }
            Alert::success('User account creation complete', 'Success')->persistent('Close');
            return redirect()->route('user.index');
        } else {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('user.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::findorFail($this->property);
        $user = User::findorFail($id);
        $access = PropertyAccess::all();
        return view('pages.user.show', compact('property', 'user', 'access'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::findorFail($this->property);
        $user = User::findorFail($id);
        $roles = Role::all();
        $properties = Property::all();
        $access = PropertyAccess::all();
        $access_properties_id = PropertyAccess::select('property_id')->where('user_id', $user->id)->get();
        return view('pages.user.edit', compact('property', 'user', 'properties', 'roles', 'access', 'access_properties_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);

        $request->validate([
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'middlename' => 'max:255',
            'birthdate' => 'date',
            'username' => [
                        'required',
                        Rule::unique('users')->ignore($user->id),
                        ],
            'email' => [
                        'required',
                        Rule::unique('users')->ignore($user->id),
                        ],
            'password_current' => 'nullable|min:6',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable|min:6|same:password',
            'role' => 'required',
        ]);
        
        // Creating user
        $user_updated = $user->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'birthdate' => $request->birthdate,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Check if password is being changed
        if ($request->password_current != null) {
            if (Hash::check($request->password_current, $user->password)) {
                $usercredentials_updated = $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
        }

        if ($user_updated) {
            $user->syncRoles([$request->role]);
            // Reset all assignments
            $assigned_destory = PropertyAccess::where('user_id', $user->id)->delete();
            if ($request->properties != null) {
                if(count($request->properties)>0) {
                        foreach($request->properties as $item => $v) {
                            // Create each property assignment
                            $array = array (
                                'user_id' => $user->id,
                                'property_id' => $request->properties[$item],
                            );
                            $assigned_to = PropertyAccess::insert($array);
                        }
                }
            }
            Alert::success('User account has been updated', 'Success')->persistent('Close');
            return redirect()->route('user.index');
        } else {
            Alert::error('Encountered an error', 'Oops')->persistent('Close');
            return redirect()->route('user.edit', $user->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
