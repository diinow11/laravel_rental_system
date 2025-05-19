<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('tenant.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'id_number' => 'required|string',
        ]);
    
        $tenant = \App\Models\Tenant::where('phone', $request->phone)
                    ->where('id_number', $request->id_number)
                    ->first();
    
        if ($tenant) {
            Auth::guard('tenant')->login($tenant);
            return redirect()->route('tenant.dashboard');
        }
    
        return back()->withErrors([
            'phone' => 'Invalid phone or ID number.',
        ]);
    }

    public function logout()
    {
        Auth::guard('tenant')->logout();
        return redirect()->route('tenant.login');
    }
}
