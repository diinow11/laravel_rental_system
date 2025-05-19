{{-- CASCADE_MARKER_APARTMENTS_GLOBAL --}}
@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">Apartments</h2>

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Apartments</h4>
            <button class="btn btn-primary" id="toggleFormBtn">+ New Apartment</button>
        </div>
        <div class="card-body" id="formPanel" style="display: none;">
            <form action="{{ route('admin.apartments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Total Units</label>
                        <input type="number" name="total_units" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Available Units</label>
                        <input type="number" name="available_units" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save Apartment</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Units</th>
                        <th>Available Units</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment->name }}</td>
                            <td>{{ $apartment->total_units }}</td>
                            <td>{{ $apartment->available_units }}</td>
                            <td>{{ $apartment->location }}</td>
                            <td>{{ ucfirst($apartment->status) }}</td>
                            <td>{{ $apartment->added_by }}</td>
                            <td>{{ $apartment->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">No apartments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('toggleFormBtn').addEventListener('click', function () {
        var form = document.getElementById('formPanel');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    });
</script>
@endpush
