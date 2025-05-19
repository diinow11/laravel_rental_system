{{-- CASCADE_MARKER_INVOICES_GLOBAL --}}
@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">Invoices</h2>
@section('content')
<div class="container-fluid">
    <h2 class="text-white mb-4">🧾 Invoices</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <input type="text" class="form-control bg-dark text-white border-secondary w-25" id="searchInput" placeholder="Search by tenant name...">
        <button class="btn btn-info btn-sm" onclick="toggleInvoiceForm()">+ New Invoice</button>
    </div>
   

    <!-- Inline Form -->
    <div id="invoiceForm" class="card-body" style="display: none;">
        <form action="{{ route('admin.invoices.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="text-white">Tenant</label>
                    <select name="tenant_id" class="form-control" required>
                        <option value="">Select Tenant</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2"><label class="text-white">Apartment</label><input name="apartment" class="form-control" required></div>
                <div class="col-md-4 mb-2"><label class="text-white">House Unit</label><input name="house_unit" class="form-control" required></div>
                <div class="col-md-4 mb-2"><label class="text-white">Rent Amount</label><input name="rent_amount" type="number" class="form-control" required></div>
                <div class="col-md-4 mb-2"><label class="text-white">Water Utility</label><input name="water_utility" type="number" class="form-control"></div>
                <div class="col-md-4 mb-2"><label class="text-white">Electricity Utility</label><input name="electricity_utility" type="number" class="form-control"></div>
                <div class="col-md-4 mb-2"><label class="text-white">Amount Due</label><input name="amount_due" type="number" class="form-control" required></div>
                <div class="col-md-4 mb-2"><label class="text-white">Amount Paid</label><input name="amount_paid" type="number" class="form-control"></div>
                <div class="col-md-4 mb-2"><label class="text-white">Due Date</label><input name="due_date" type="date" class="form-control" required></div>
                <div class="col-md-4 mb-2">
                    <label class="text-white">Payment Status</label>
                    <select name="payment_status" class="form-control" required>
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary mt-2">Save Invoice</button>
        </form>
    </div>

    <!-- Invoices Table -->
    <div class="card bg-dark text-white">
        <div class="card-body table-responsive">
            <table class="table table-dark table-striped" id="invoiceTable">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Phone</th>
                        <th>Apartment</th>
                        <th>Unit</th>
                        <th>Rent</th>
                        <th>Water</th>
                        <th>Electricity</th>
                        <th>Due</th>
                        <th>Paid</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->tenant->name }}</td>
                        <td>{{ $invoice->tenant->phone_number ?? '-' }}</td>
                        <td>{{ $invoice->apartment }}</td>
                        <td>{{ $invoice->house_unit }}</td>
                        <td>{{ number_format($invoice->rent_amount, 2) }}</td>
                        <td>{{ number_format($invoice->water_utility, 2) }}</td>
                        <td>{{ number_format($invoice->electricity_utility, 2) }}</td>
                        <td>{{ number_format($invoice->amount_due, 2) }}</td>
                        <td>{{ number_format($invoice->amount_paid, 2) }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>{{ ucfirst($invoice->payment_status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function toggleInvoiceForm() {
    const form = document.getElementById('invoiceForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

document.getElementById('searchInput').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('#invoiceTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
    });
});
</script>
@endsection
