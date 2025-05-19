<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    // Display apartment list
    public function index()
    {
        $apartments = Apartment::latest()->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    // Store new apartment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_units' => 'required|integer|min:1',
            'available_units' => 'required|integer|min:0|lte:total_units',
            'location' => 'required|string|max:255',
        ]);

        Apartment::create([
            'name' => $request->name,
            'total_units' => $request->total_units,
            'available_units' => $request->available_units,
            'status' => 'available',
            'location' => $request->location,
            'added_by' => Auth::user()->name,
        ]);

        return redirect()->route('admin.apartments.index')->with('success', 'Apartment added successfully.');
    }
}
