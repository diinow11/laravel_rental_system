{{-- CASCADE_MARKER_HOUSE_UNITS_GLOBAL --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">House Units</h2>

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">House Units</h4>
            <button class="btn btn-warning" id="toggleUnitForm">+ New House Units</button>
        </div>

        <!-- Inline Add Form (Initially Hidden) -->
        <div class="card-body" id="unitForm" style="display:none;">
            <form action="{{ route('admin.house-units.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Apartment -->
                    <div class="col-md-6 mb-3">
                        <label>Apartment <span class="text-danger">*</span></label>
                        <select name="apartment_id" class="form-control" required>
                            <option value="">Select an option</option>
                            @foreach($apartments as $apartment)
                                <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unit Label -->
                    <div class="col-md-6 mb-3">
                        <label>House Unit Label <span class="text-danger">*</span></label>
                        <input type="text" name="unit_label" class="form-control" placeholder="e.g. A01" required>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label>Type <span class="text-danger">*</span></label>
                        <input type="text" name="type" class="form-control" placeholder="e.g. Bedsitter" required>
                    </div>

                    <!-- Rent & Deposit -->
                    <div class="col-md-6 mb-3">
                        <label>Rent Amount <span class="text-danger">*</span></label>
                        <input type="number" name="rent" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Deposit Amount <span class="text-danger">*</span></label>
                        <input type="number" name="deposit" class="form-control" required>
                    </div>

                    <!-- Utilities -->
                    <div class="col-md-6 mb-3">
                        <label>Water Utility</label>
                        <input type="number" name="water_utility" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Electricity Utility</label>
                        <input type="number" name="electricity_utility" class="form-control">
                    </div>

                    <!-- Bedrooms, Bathrooms, Kitchens -->
                    <div class="col-md-4 mb-3">
                        <label>Bedrooms</label>
                        <input type="number" name="bedrooms" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Bathrooms</label>
                        <input type="number" name="bathrooms" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Kitchens</label>
                        <input type="number" name="kitchens" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Save House Unit</button>
            </form>
        </div>

        <!-- House Units Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Unit Name</th>
                            <th>Apartment Name</th>
                            <th>Type</th>
                            <th>Rent</th>
                            <th>Deposit</th>
                            <th>Water</th>
                            <th>Electricity</th>
                            <th>Bedrooms</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($houseUnits as $unit)
                        <tr>
                            <td>{{ $unit->unit_label }}</td>
                            <td>{{ $unit->apartment->name }}</td>
                            <td>{{ $unit->type }}</td>
                            <td>{{ $unit->rent }}</td>
                            <td>{{ $unit->deposit }}</td>
                            <td>{{ $unit->water_utility }}</td>
                            <td>{{ $unit->electricity_utility }}</td>
                            <td>{{ $unit->bedrooms }}</td>
                            <td>
                                <!-- You can add edit/delete buttons here -->
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No house units available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('toggleUnitForm').addEventListener('click', function () {
        const form = document.getElementById('unitForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
</script>
@endpush
