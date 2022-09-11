<?php

namespace Smbplus\UserManagement\Http\Controllers;

use Smbplus\UserManagement\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;


class RoleController extends Controller
{

    //protected $guard = 'web'; //example :admin or :spum

    public function __construct()
    {
        //$this->middleware('auth:spum_admin'); --> work on this later for custom guard
        $this->middleware('auth');
    }
    
    public function index()
    {
        $roles = Role::orderBy('name');

        $roles = $roles->paginate(config('smbplus_um.items_per_page', 1));

        $roles->setPath('');

        return view('spum::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('spum::roles.add', ['role' => new Role()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);


        return redirect(route('roles.index'));
    }

    public function edit(Request $request,Role $role)
    {
        return view('spum::roles.edit', compact('role'));
    }

    public function update(Request $request,Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role->name = $request->name;
        $role->guard_name = $request->guard_name;

        $role->save();
        

        return redirect(route('roles.index'))->with('success', 'Role updated success');
    }


}