<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentPayment;
use App\Models\Tenant;
use App\Models\Invoice;
use App\Models\PaymentMode;

class RentPaymentController extends Controller
{
    public function index()
    {
        $rentPayments = RentPayment::with(['tenant', 'invoice', 'paymentMode'])->latest()->get();
        $tenants = Tenant::all();
        $invoices = Invoice::all();
        $paymentModes = PaymentMode::all();

        return view('admin.rent_payments.index', compact(
            'rentPayments',
            'tenants',
            'invoices',
            'paymentModes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|string',
            'invoice_id' => 'nullable|exists:invoices,id',
            'is_correction' => 'nullable|boolean',
        ]);
    
        RentPayment::create([
            'tenant_id' => $validated['tenant_id'],
            'amount' => $validated['amount'],
            'payment_mode' => $validated['payment_mode'],
            'invoice_id' => $validated['invoice_id'] ?? null,
            'is_correction' => $validated['is_correction'] ?? false,
        ]);
    
        return redirect()->back()->with('success', 'Rent payment recorded successfully.');
    }
}