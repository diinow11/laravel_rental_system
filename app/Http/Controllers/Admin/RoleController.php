<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{public function index()
    {
        $permissions = Permission::all(); // <- Just the raw list
        $roles = Role::all();
    
        return view('admin.roles.index', compact('permissions', 'roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);
    
        $role = Role::create(['name' => $request->name]);
    
        if ($request->has('permissions')) {
            $permissionNames = \Spatie\Permission\Models\Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();
        
            $role->syncPermissions($permissionNames);
        }
    
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted.');
    }
}
