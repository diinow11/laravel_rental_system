@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(20,20,40,0.10); padding: 0 0 32px 0; border: none;">
    <div class="card-header" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); border-top-left-radius: 18px; border-top-right-radius: 18px; padding: 28px 32px 18px 32px; border-bottom: none;">
        <h2 style="color: #fff; margin: 0; font-weight: 700; font-size: 2rem; letter-spacing: 0.5px;">Admit a New Tenant</h2>
    </div>
    <div class="card-body" style="padding: 28px 32px 0 32px; background: #fff; border-radius: 0 0 18px 18px;">
        <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">
                    {{-- Apartment --}}
                    <div class="col-md-6 mb-3">
                        <label for="apartment_id" class="form-label">Apartment <span class="text-danger">*</span></label>
                        <select name="apartment_id" id="apartment_id" class="form-control" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                            <option value="">Select an option</option>
                            @foreach($apartments as $apartment)
                                <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- House Unit --}}
                    <div class="col-md-6 mb-3">
                        <label for="house_unit_id" class="form-label">House Unit <span class="text-danger">*</span></label>
                        <select name="house_unit_id" id="house_unit_id" class="form-control" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                            <option value="">Select an option</option>
                            @foreach($houseUnits as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    {{-- Tenant Name --}}
                    <div class="col-md-6 mb-3">
                        <label for="name">Tenant Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Obed Paul" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. obed@rhms.com" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                    </div>
                </div>

                <div class="row">
                    {{-- Phone --}}
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. 0712345678" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                    </div>

                    {{-- ID Number --}}
                    <div class="col-md-6 mb-3">
                        <label for="id_number">Identification Number <span class="text-danger">*</span></label>
                        <input type="text" name="id_number" class="form-control" placeholder="e.g. 30123890" required style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                    </div>
                </div>

                {{-- Tenancy Agreement File Upload --}}
                <div class="mb-4">
                    <label for="tenancy_agreement">Select Tenancy Agreement</label>
                    <input type="file" name="tenancy_agreement" class="form-control" accept="application/pdf" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                    <small class="form-text text-muted">Drag & Drop your files or <strong>Browse</strong></small>
                </div>

                <button type="submit" class="btn" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; border-radius: 8px; font-weight: 600; font-size: 1.1rem; padding: 12px 32px; border: none; box-shadow: 0 2px 8px rgba(20,20,40,0.08); transition: background 0.2s;">Admit Tenant</button>
            </form>
        </div>
    </div>
</div>
@endsection
