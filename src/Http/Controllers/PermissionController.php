<?php

namespace Smbplus\UserManagement\Http\Controllers;

use Smbplus\UserManagement\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $permissions = Permission::all()->pluck('name');
        

        return view('spum::permissions.index', compact('permissions'));
    }

    public function show()
    {
        $permission = Permission::findOrFail(request('permission'));

        return view('spum::permissions.show', compact('permission'));
    }

    public function store()
    {
        // Let's assume we need to be authenticated
        // to create a new post
        if (! auth()->check()) {
            abort (403, 'Only authenticated permissions can create new permission.');
        }

        request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        // Assume the authenticated permission is the post's author
        $author = auth()->permission();

        //return redirect(route('posts.show', $post));
    }


}