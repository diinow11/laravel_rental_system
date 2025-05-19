{{-- CASCADE_MARKER_RENT_PAYMENTS_GLOBAL --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">Rent Payments</h2> {{-- or your custom layout --}}
@section('content')
<div class="container-fluid">
    <h2 class="text-white mb-4">🏠 Rent Payments</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search + Filter --}}
    <div class="d-flex mb-3 justify-content-between align-items-center">
        <input type="text" class="form-control me-2 bg-dark text-white border-secondary w-25" placeholder="Search tenant name..." id="searchInput">
        <button class="btn btn-sm btn-info mb-3" onclick="toggleRentPaymentForm()">+ New Rent Payment</button>

    </div>


    <!-- Hidden New Rent Payment Form -->
    <div class="card-body" id="newRentPaymentForm" style="display: none;">
    <form action="{{ route('admin.rent-payments.store') }}" method="POST">
        @csrf
      
        <div class="row">
            <!-- Tenant -->
            <div class="col-md-6 mb-3">
                <label>Tenant Name*</label>
                <select name="tenant_id" class="form-control" required>
                    <option value="">Select Tenant</option>
                    @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Invoice -->
            <div class="col-md-6 mb-3">
                <label>Select Invoice Amount (optional)</label>
                <select name="invoice_id" class="form-control">
                    <option value="">None</option>
                    @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->id }}">{{ $invoice->amount }} €</option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div class="col-md-6 mb-3">
                <label>Amount (€)*</label>
                <input type="number" name="amount" class="form-control" placeholder="e.g. 30000" required>
            </div>

            <!-- Payment Mode -->
            <div class="col-md-6 mb-3">
                <label>Payment Mode*</label>
                <select name="payment_mode" class="form-control" required>
                    <option value="">Select Mode</option>
                    <option value="Cash">Cash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Mobile Money">Mobile Money</option>
                </select>
            </div>

            <!-- Is Correction -->
            <div class="col-md-6 mb-3">
                <label>Is this a correction?*</label>
                <select name="is_correction" class="form-control" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>


      

    {{-- Payments Table --}}
    <div class="card bg-dark text-white">
        <div class="card-body table-responsive">
            <table class="table table-dark table-striped" id="paymentTable">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Amount</th>
                        <th>Mode</th>
                        <th>Invoice</th>
                        <th>Correction</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentPayments as $payment)
                    <tr>
                        <td>{{ $payment->tenant->name }}</td>
                        <td>{{ number_format($payment->amount, 2) }} €</td>
                        <td>{{ $payment->paymentMode->name ?? '-' }}</td>
                        <td>{{ $payment->invoice?->id ?? '-' }}</td>
                        <td>{{ $payment->is_correction ? 'Yes' : 'No' }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleForm() {
        const form = document.getElementById('newPaymentForm');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }

    // Simple search
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#paymentTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>
<script>
    function toggleRentPaymentForm() {
        const form = document.getElementById('newRentPaymentForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

@endsection
