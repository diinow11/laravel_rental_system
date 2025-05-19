<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $invoices = Invoice::with('tenant')
            ->when($search, fn($q) => $q->whereHas('tenant', fn($t) => $t->where('name', 'like', "%$search%")))
            ->latest()->get();

        $tenants = Tenant::all();
        return view('admin.invoices.index', compact('invoices', 'tenants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'apartment' => 'required|string|max:255',
            'house_unit' => 'required|string|max:255',
            'rent_amount' => 'required|numeric',
            'water_utility' => 'nullable|numeric',
            'electricity_utility' => 'nullable|numeric',
            'amount_due' => 'required|numeric',
            'amount_paid' => 'nullable|numeric',
            'due_date' => 'required|date',
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        Invoice::create($data);
        return redirect()->back()->with('success', 'Invoice recorded successfully.');
    }

  
}