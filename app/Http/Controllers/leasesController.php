<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   // ← only one import
use App\Models\Lease;
use App\Models\Employee;
use App\Models\Property;

class leasesController extends Controller
{
    public function index(Request $request)
    {
        $leases = Lease::orderBy('lid', 'desc')->get();
        if ($request->ajax()) {
            return view('admin.leases.index-panel', compact('leases'));
        }
        return view('admin.leases.index', compact('leases'));
    }

    public function create(Request $request)
    {
        $employees = Employee::all();
        $properties= Property::all();
        if ($request->ajax()) {
            return view('admin.leases.create-panel', compact('employees','properties'));
        }
        return view('admin.leases.create', compact('employees','properties'));
    }

    public function store(Request $request)
    {
        $l = new Lease();
        $l->eid         = $request->eid;
        $l->pid         = $request->pid;
        $l->duration    = $request->duration;
        $l->lease_start = $request->lease_start;
        $l->lease_expire= $request->lease_expire;
        $l->rent        = $request->rent;
        $l->description = $request->description;
        $l->save();

        if ($request->ajax()) {
            $leases = Lease::orderBy('lid','desc')->get();
            return view('admin.leases.index-panel', compact('leases'));
        }
        return redirect('leases/create');
    }

    public function edit(Request $request, $lid)
    {
        $lease     = Lease::findOrFail($lid);
        $employees = Employee::all();
        $properties= Property::all();
        if ($request->ajax()) {
            return view('admin.leases.edit-panel', compact('lease','employees','properties'));
        }
        return view('admin.leases.edit', compact('lease','employees','properties'));
    }

    public function update(Request $request, $lid)
    {
        $l = Lease::findOrFail($lid);
        $l->eid         = $request->eid;
        $l->pid         = $request->pid;
        $l->duration    = $request->duration;
        $l->lease_start = $request->lease_start;
        $l->lease_expire= $request->lease_expire;
        $l->rent        = $request->rent;
        $l->description = $request->description;
        $l->save();

        if ($request->ajax()) {
            $leases = Lease::orderBy('lid','desc')->get();
            return view('admin.leases.index-panel', compact('leases'));
        }
        return redirect('leases');
    }

    public function destroy(Request $request, $lid)
    {
        $l = Lease::findOrFail($lid);
        $l->delete();
        if ($request->ajax()) {
            $leases = Lease::orderBy('lid','desc')->get();
            return view('admin.leases.index-panel', compact('leases'));
        }
        return redirect('leases');
    }
}
