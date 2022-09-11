<?php

namespace Smbplus\UserManagement\Http\Controllers;

use Smbplus\UserManagement\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $keyword = trim($request->keyword);

        $users = new User();

        if($keyword != ''){
            
            $users = $users->where(function ($query) use ($keyword){
                $query->where('name', 'like', '%' . $keyword . '%')
                      ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        $users = $users->orderBy('name');

        $users = $users->paginate(config('smbplus_um.items_per_page', 20));

        $users->setPath('');

        return view('spum::users.index', compact('users', 'keyword'));
    }

    public function create()
    {
        $roles = Role::orderBy('name', 'DESC')->get()->pluck('name');

        return view('spum::users.add', ['user' => new User(), 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8'
        ]);
        
        $password = trim($request->password);
        $retypePassword = trim($request->retype_password);

        if($password != $retypePassword){
            return redirect(route('users.create'))->withErrors(['Password does not match']);
        }

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active,
            'password' => Hash::make($password)
        ]);

        $user->syncRoles($request->roles);
        
        return redirect(route('users.index'))->with('success', 'New user created success');
    }

    public function edit(Request $request,User $user)
    {
        $roles = Role::orderBy('name', 'DESC')->get()->pluck('name');

        return view('spum::users.edit', compact('user', 'roles'));
    }

    public function update(Request $request,User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id
        ]);

        $password = trim($request->password);
        if($password != ''){
            $retypePassword = trim($request->retype_password);

            if($password != $retypePassword){
                return redirect(route('users.edit', ['user' => $user->id]))->withErrors(['Password does not match']);
            }

            $user->password = Hash::make($password);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active;

        $user->save();
        
        $user->syncRoles($request->roles);
        

        return redirect(route('users.index'))->with('success', 'User updated success');
    }


}