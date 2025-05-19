<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant = Auth::guard('tenant')->user();
    
        // Get related data
        $tenant->load('apartment', 'houseUnit', 'invoices');
    
        // Calculate balance from invoices
        $balance = $tenant->invoices->sum(function ($invoice) {
            return $invoice->payment_status === 'unpaid' ? $invoice->amount_due : 0;
        });
    
        return view('tenant.dashboard', [
            'tenant' => $tenant,
            'invoices' => $tenant->invoices,
            'balance' => $balance,
        ]);
    }
}
