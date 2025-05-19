<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;            // ← inject Request
use App\Models\Property;
use App\Models\Location;

class propertiesController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::orderBy('pid','desc')->get();
        if ($request->ajax()) {
            return view('admin.properties.index-panel', compact('properties'));
        }
        return view('admin.properties.index', compact('properties'));
    }

    public function create(Request $request)
    {
        $locations = Location::all();
        if ($request->ajax()) {
            return view('admin.properties.create-panel', compact('locations'));
        }
        return view('admin.properties.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $p = new Property();
        $p->location    = $request->location;
        $p->price       = $request->price;
        $p->area        = $request->area;
        $p->type        = $request->type;
        $p->baths       = $request->baths;
        $p->rooms       = $request->rooms;
        $p->stories     = $request->stories;
        $p->description = $request->description;
        $p->save();

        if ($request->ajax()) {
            $properties = Property::orderBy('pid','desc')->get();
            return view('admin.properties.index-panel', compact('properties'));
        }
        return redirect('properties/create');
    }

    public function edit(Request $request, $pid)
    {
        $property  = Property::findOrFail($pid);
        $locations = Location::all();
        if ($request->ajax()) {
            return view('admin.properties.edit-panel', compact('property','locations'));
        }
        return view('admin.properties.edit', compact('property','locations'));
    }

    public function update(Request $request, $pid)
    {
        $p = Property::findOrFail($pid);
        $p->location    = $request->location;
        $p->price       = $request->price;
        $p->area        = $request->area;
        $p->type        = $request->type;
        $p->baths       = $request->baths;
        $p->rooms       = $request->rooms;
        $p->stories     = $request->stories;
        $p->description = $request->description;
        $p->save();

        if ($request->ajax()) {
            $properties = Property::orderBy('pid','desc')->get();
            return view('admin.properties.index-panel', compact('properties'));
        }
        return redirect('properties');
    }

    public function destroy(Request $request, $pid)
    {
        $p = Property::findOrFail($pid);
        $p->delete();

        if ($request->ajax()) {
            $properties = Property::orderBy('pid','desc')->get();
            return view('admin.properties.index-panel', compact('properties'));
        }
        return redirect('properties');
    }
}
