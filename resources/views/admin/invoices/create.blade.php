@extends('admin.layouts.master')
@section('content')
<div style="max-width:480px;margin:0 auto;background:var(--card-bg);box-shadow:var(--card-shadow);border-radius:18px;padding:36px 32px;">
    <h2 style="margin-bottom:24px;font-weight:600;font-size:1.5rem;">Create New Invoice</h2>
    <form method="POST" action="{{ route('admin.invoices.store') }}">
        @csrf
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Tenant Name</label>
            <input type="text" name="tenant_name" class="form-control" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Amount</label>
            <input type="number" name="amount" class="form-control" min="0" step="0.01" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Due Date</label>
            <input type="date" name="due_date" class="form-control" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Description</label>
            <textarea name="description" class="form-control" rows="3" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;"></textarea>
        </div>
        <button type="submit" style="background:var(--primary);color:#fff;padding:12px 24px;border-radius:8px;font-weight:600;border:none;">Create Invoice</button>
    </form>
</div>
@endsection
