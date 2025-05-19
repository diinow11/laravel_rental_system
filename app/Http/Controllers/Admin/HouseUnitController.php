<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HouseUnit;
use App\Models\Apartment;
use Illuminate\Http\Request;

class HouseUnitController extends Controller
{
    // Show list + inline creation form
    public function index()
    {
        $houseUnits = HouseUnit::with('apartment')->latest()->get();
        $apartments = Apartment::all();

        return view('admin.house-units.index', compact('houseUnits', 'apartments'));
    }

    // Store new unit
    public function store(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'unit_label' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'rent' => 'required|integer|min:0',
            'deposit' => 'required|integer|min:0',
            'water_utility' => 'required|integer|min:0',
            'electricity_utility' => 'required|integer|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'kitchens' => 'nullable|integer|min:0',
        ]);

        HouseUnit::create($request->all());

        return redirect()->route('admin.house-units.index')->with('success', 'House unit added successfully.');

    }

    // Delete unit
    public function destroy($id)
    {
        $unit = HouseUnit::findOrFail($id);
        $unit->delete();

        return redirect()->route('house-units.index')->with('success', 'House unit deleted.');
    }
}
