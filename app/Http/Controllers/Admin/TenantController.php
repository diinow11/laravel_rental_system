<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Apartment;
use App\Models\HouseUnit;
use App\Models\Invoice; // ✅ Required
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\TenantNotification;
use Illuminate\Support\Facades\Mail;
use App\Services\SMSService;
use AfricasTalking\SDK\AfricasTalking;



class TenantController extends Controller
{
    /**
     * Show the list of tenants with search and filters.
     */
    public function index(Request $request)
    {
        $query = Tenant::with(['apartment', 'houseUnit']);

        // Search by name or house unit label
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('houseUnit', function ($q) use ($search) {
                      $q->where('unit_label', 'like', "%{$search}%");
                  });
        }

        // Filter by rent balance
        if ($request->has('with_balance')) {
            $query->where('rent_balance', '>', 0);
        }

        if ($request->has('without_balance')) {
            $query->where('rent_balance', '=', 0);
        }

        // Filter by apartment
        if ($request->filled('apartment_id')) {
            $query->where('apartment_id', $request->apartment_id);
        }

        // Filter by tenancy status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tenants = $query->latest()->get();
        $apartments = Apartment::all();
        $houseUnits = HouseUnit::all();

        return view('admin.tenants.index', compact('tenants', 'apartments', 'houseUnits'));
    }

    /**
     * Store a new tenant.
     */
    public function store(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'house_unit_id' => 'required|exists:house_units,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:50',
            'tenancy_agreement' => 'nullable|file|mimes:pdf|max:2048',
            'scanned_id' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('tenancy_agreement')) {
            $filePath = $request->file('tenancy_agreement')->store('tenancy_agreements', 'public');
        }

        $scannedIdPath = null;
        if ($request->hasFile('scanned_id')) {
            $scannedIdPath = $request->file('scanned_id')->store('scanned_ids', 'public');
        }

        Tenant::create([
            'apartment_id' => $request->apartment_id,
            'house_unit_id' => $request->house_unit_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_number' => $request->id_number,
            'tenancy_agreement' => $filePath,
            'scanned_id' => $scannedIdPath,
        ]);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant added successfully.');
    }

    /**
     * Bulk invoice creation for selected tenants.
     */
    public function bulkCreateInvoices(Request $request)
{
    $request->validate([
        'tenant_ids' => 'required|string',
        'due_date' => 'required|date',
    ]);

    $tenantIds = explode(',', $request->tenant_ids);

    foreach ($tenantIds as $id) {
        $tenant = Tenant::with('houseUnit.apartment')->find($id);

        $houseUnit = $tenant->houseUnit;
        $apartment = $houseUnit?->apartment;

        Invoice::create([
            'tenant_id'           => $tenant->id,
            'phone_number'        => $tenant->phone ?? '-',
            'apartment'           => $apartment?->name ?? '-',
            'house_unit'          => $houseUnit?->label ?? '-',
            'rent_amount'         => $houseUnit?->rent ?? 0,
            'water_utility'       => $houseUnit?->water_utility ?? 0,
            'electricity_utility' => $houseUnit?->electricity_utility ?? 0,
            'amount_due'          => ($houseUnit?->rent ?? 0) + ($houseUnit?->water_utility ?? 0) + ($houseUnit?->electricity_utility ?? 0),
            'amount_paid'         => 0,
            'due_date'            => $request->due_date,
            'payment_status'      => 'unpaid',
        ]);
    }

    return redirect()->back()->with('success', 'Invoices created for selected tenants.');
}


    public function notify(Request $request)
{
    $request->validate([
        'tenant_ids' => 'required|string',
        'method' => 'required|in:sms,email',
        'message' => 'required|string',
    ]);

    $tenantIds = explode(',', $request->tenant_ids);
    $method = $request->method;
    $message = $request->message;

    $tenants = Tenant::whereIn('id', $tenantIds)->get();

    foreach ($tenants as $tenant) {
        if ($method === 'email') {
            \Log::info("Send EMAIL to {$tenant->email}: $message");
        } else {
            \Log::info("Send SMS to {$tenant->phone}: $message");
        }
    }

    return redirect()->back()->with('success', 'Notifications triggered (check logs).');
}



public function sendNotification(Request $request)
{
    $request->validate([
        'tenant_ids' => 'required|string',
        'message' => 'required|string',
        'subject' => 'nullable|string',
        'send_email' => 'nullable',
        'send_sms' => 'nullable',
    ]);

    $tenantIds = explode(',', $request->tenant_ids);
    $tenants = Tenant::whereIn('id', $tenantIds)->get();

    // ✅ Initialize Africa's Talking
    $AT = new AfricasTalking(
        env('AFRICASTALKING_USERNAME'),
        env('AFRICASTALKING_API_KEY')
    );
    $smsService = $AT->sms();

    foreach ($tenants as $tenant) {

        // ✅ Send Email if selected
        if ($request->has('send_email')) {
            Mail::to($tenant->email)->send(new TenantNotification(
                $request->subject ?? 'Notification',
                $request->message
            ));
        }

        // ✅ Send SMS if selected
        if ($request->has('send_sms')) {
            try {
                $smsService->send([
                    'to' => $tenant->phone,
                    'message' => $request->message,
                    'from' => env('AFRICASTALKING_SENDER') // Optional
                ]);
            } catch (\Exception $e) {
                \Log::error("SMS failed to {$tenant->phone}: " . $e->getMessage());
            }
        }
    }

    return redirect()->back()->with('success', 'Notifications sent successfully.');
}

    
    

    
}
