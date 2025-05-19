@extends('layouts.tenant')

@section('content')
    <h4>Dashboard</h4>
    <p>Summary of your tenancy account..</p>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    {{-- Unpaid alert --}}
    @if($balance > 0)
    <div class="alert alert-danger">
        <strong>You have an unpaid invoice</strong><br>
        <div><strong>Balance:</strong> KES {{ number_format($balance) }}</div>
        <form class="mt-3" method="POST" action="{{ route('tenant.pay') }}">
    @csrf

    <input type="hidden" name="invoice_id" value="{{ $latestUnpaidInvoice->id ?? '' }}">

    <div>
        <label>Mpesa Number (Safaricom)</label>
        <input type="text" name="phone" class="form-control" value="{{ $tenant->phone }}" required>
    </div>

    <div class="mt-2">
        <label>Amount to pay:</label>
        <input type="number" name="amount" class="form-control" value="{{ $balance }}" required>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-dark" onclick="window.location.reload()">Cancel</button>
        <button type="submit" name="action" value="initiate" class="btn btn-primary">Initiate Payment</button>
        <button type="submit" name="action" value="confirm" class="btn btn-success">Confirm Payment</button>
    </div>
</form>

    </div>
    @endif

    {{-- Summary Boxes --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>A/C Balance</strong><br>
                KES {{ number_format(-$balance) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-info">
                <strong>House</strong><br>
                {{ $tenant->apartment->name ?? 'N/A' }}, {{ $tenant->houseUnit->label ?? 'N/A' }}
            </div>
        </div>
    </div>

    {{-- Payments (add real data later) --}}
    <h5>Payments</h5>
    <p>Example payments go here...</p>

    {{-- Invoices --}}
    <h5>Invoices</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ number_format($invoice->amount_due) }}</td>
                <td>{{ ucfirst($invoice->payment_status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


@section('scripts')


<script>
   function initiatePayment() {
    fetch('/api/mpesa/stkpush', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            phone: '254708374149' // replace with dynamic phone if needed
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        alert(data.CustomerMessage || 'Check console for response.');
    })
    .catch(err => {
        console.error("Error:", err);
        alert("An error occurred. Check console.");
    });
}

</script>

@endsection
