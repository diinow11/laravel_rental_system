<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class employeesController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::orderBy('eid','desc')->get();
        if ($request->ajax()) {
            return view('admin.employees.index-panel', compact('employees'));
        }
        return view('admin.employees.index', compact('employees'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.employees.create-panel');
        }
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $e = new Employee();
        $e->first_name = $request->first_name;
        $e->last_name  = $request->last_name;
        $e->address    = $request->address;
        $e->dob        = $request->dob;
        $e->age        = $request->age;
        $e->gender     = $request->gender;
        $e->cnic       = $request->cnic;
        $e->hire_date  = $request->hire_date;
        $e->contact_no = $request->contact_no;
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('employees','public');
            $e->image_path = basename($path);
        }
        $e->save();

        if ($request->ajax()) {
            $employees = Employee::orderBy('eid','desc')->get();
            return view('admin.employees.index-panel', compact('employees'));
        }
        return redirect('employees');
    }

    public function edit(Request $request, $eid)
    {
        $employee = Employee::findOrFail($eid);
        if ($request->ajax()) {
            return view('admin.employees.edit-panel', compact('employee'));
        }
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $eid)
    {
        $e = Employee::findOrFail($eid);
        $e->first_name = $request->first_name;
        // ... same assignments as store() ...
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('employees','public');
            $e->image_path = basename($path);
        }
        $e->save();

        if ($request->ajax()) {
            $employees = Employee::orderBy('eid','desc')->get();
            return view('admin.employees.index-panel', compact('employees'));
        }
        return redirect('employees');
    }

    public function destroy(Request $request, $eid)
    {
        $e = Employee::findOrFail($eid);
        if ($e->image_path) {
            \Storage::disk('public')->delete('employees/'.$e->image_path);
        }
        $e->delete();
        if ($request->ajax()) {
            $employees = Employee::orderBy('eid','desc')->get();
            return view('admin.employees.index-panel', compact('employees'));
        }
        return redirect('employees');
    }
}