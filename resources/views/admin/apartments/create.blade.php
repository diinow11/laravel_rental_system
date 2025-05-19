@extends('admin.layouts.master')
@section('content')
<div style="max-width:480px;margin:0 auto;background:var(--card-bg);box-shadow:var(--card-shadow);border-radius:18px;padding:36px 32px;">
    <h2 style="margin-bottom:24px;font-weight:600;font-size:1.5rem;">Add New Property</h2>
    <form method="POST" action="{{ route('admin.apartments.store') }}">
        @csrf
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Property Name</label>
            <input type="text" name="name" class="form-control" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Total Units</label>
            <input type="number" name="total_units" class="form-control" min="1" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Available Units</label>
            <input type="number" name="available_units" class="form-control" min="0" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;color:var(--text-secondary);">Location</label>
            <input type="text" name="location" class="form-control" required style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
        <button type="submit" style="background:var(--primary);color:#fff;padding:12px 24px;border-radius:8px;font-weight:600;border:none;">Add Property</button>
    </form>
</div>
@endsection
