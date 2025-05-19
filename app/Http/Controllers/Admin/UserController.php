<?php
// app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
    
        return view('admin.users.index', compact('users', 'roles'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|exists:roles,id',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        
    ]);

    $user->assignRole(Role::find($request->role)->name);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}
    public function edit(Request $request, User $user)
    {
        $roles = Role::all();
        $view = $request->ajax() ? 'admin.users.edit-panel' : 'admin.users.edit';
        return view($view, compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        $user->syncRoles($request->roles);

        if ($request->ajax()) {
            return view('admin.users.index-panel', ['users' => User::with('roles')->get()]);
        }
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        if (request()->ajax()) {
            return view('admin.users.index-panel', ['users' => User::with('roles')->get()]);
        }
        return redirect()->route('admin.users.index');
    }
}