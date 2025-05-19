{{-- CASCADE_MARKER_TENANTS_GLOBAL --}}
@extends('admin.layouts.master')

@section('content')
<div class="dashboard-content" style="max-width: 1200px; margin: 0 auto;">
    <div class="card" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(20,20,40,0.10); padding: 0 0 32px 0; margin-bottom: 32px; border: none;">
    <div class="card-header" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); border-top-left-radius: 18px; border-top-right-radius: 18px; padding: 28px 32px 18px 32px; border-bottom: none;">
        <h2 style="color: #fff; margin: 0; font-weight: 700; font-size: 2rem; letter-spacing: 0.5px;">Tenants</h2>
    </div>
    <div class="card-body" style="padding: 28px 32px 0 32px; background: #fff; border-radius: 0 0 18px 18px;">
        <!-- Bulk Action Controls -->
        <div id="bulk-actions-bar" class="d-none mb-4" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border-radius: 10px; padding: 14px 24px; box-shadow: 0 2px 8px rgba(20,20,40,0.08); border: 1px solid #f3f4f6;">
    <div style="flex:1; text-align:left;">
        <span id="selected-count" style="font-weight:600; color:var(--primary,#ff7e5f);">0</span> records selected
    </div>
    <div style="flex:2; display:flex; justify-content:center; gap:12px;">
        <button class="btn" id="notifyBtn" data-bs-toggle="modal" data-bs-target="#notifyModal" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; border-radius: 8px; font-weight:600; border: none; min-width:160px;">📩</button>
        <button class="btn" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; border-radius: 8px; font-weight:600; border: none; min-width:140px;" data-bs-toggle="modal" data-bs-target="#invoiceModal">
            <i class="bi bi-cash-coin"></i> Create Invoice(s)
        </button>
    </div>
    <div style="flex:1; text-align:right;">
        <a href="#" id="deselect-all" style="color: var(--danger,#ff3d3d); text-decoration:underline; font-weight:500;">Deselect all</a>
    </div>
</div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            <!-- Search and Filter Bar -->
            <div class="d-flex justify-content-between align-items-center mb-4">
    <form method="GET" action="{{ route('admin.tenants.index') }}" class="d-flex flex-grow-1 gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or House Unit..." style="flex: 1; padding: 10px 16px; border-radius: 8px; border: 1px solid #e5e7eb; background: #fff; color: #222; font-size: 1rem;">
        <button style="padding: 10px 22px; background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer;">Search</button>
    </form>
    <button id="toggleFilters" style="margin-left: 18px; padding: 10px 22px; background: transparent; color: var(--primary, #ff7e5f); border: 2px solid var(--primary, #ff7e5f); border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer;">
        <i class="fas fa-filter"></i> Filters
    </button>
</div>
            <!-- Filter Sidebar (hidden by default) -->
            <div id="filterSidebar" style="display: none; background: #f7f7fa; border-radius: 14px; box-shadow: 0 2px 8px rgba(20,20,40,0.06); padding: 18px 24px; margin-bottom: 28px;">
                <form method="GET" action="{{ route('admin.tenants.index') }}" class="row g-3 align-items-end">
                    <!-- Apartment Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Apartment</label>
                        <select name="apartment_id" class="form-select" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                            <option value="">All Apartments</option>
                            @foreach($apartments as $apartment)
                                <option value="{{ $apartment->id }}" {{ request('apartment_id') == $apartment->id ? 'selected' : '' }}>
                                    {{ $apartment->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rent Balance Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Rent Balance</label>
                        <select name="balance" class="form-select" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                            <option value="">All</option>
                            <option value="with_balance" {{ request('balance') == 'with_balance' ? 'selected' : '' }}>With Balance</option>
                            <option value="without_balance" {{ request('balance') == 'without_balance' ? 'selected' : '' }}>Without Balance</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px; padding: 10px 14px; font-size: 1rem;">
                            <option value="">All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-2">
                        <button type="submit" class="btn" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; border-radius: 8px; font-weight: 600; font-size: 1rem; padding: 10px 22px; border: none; box-shadow: 0 2px 8px rgba(20,20,40,0.08); transition: background 0.2s; margin-right: 8px;">Apply Filters</button>
                        <a href="{{ route('admin.tenants.index') }}" class="btn" style="background: #fff; color: #ff7e5f; border: 2px solid #ff7e5f; border-radius: 8px; font-weight: 600; font-size: 1rem; padding: 10px 22px; box-shadow: 0 2px 8px rgba(20,20,40,0.08); transition: background 0.2s;">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Tenants Table -->
            <div class="mt-4 p-0" style="background: #fff; border-radius: 14px; box-shadow: 0 2px 8px rgba(20,20,40,0.06);">
                <div class="table-responsive p-0">
                    <table class="table align-middle mb-0" style="background: #fff; border-radius: 14px; overflow: hidden; color: #23233a;">
                        <thead style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); color: #fff; font-weight:700; font-size:1.07rem;">
                            <tr style="background: #fff; color: #23233a;">
            
                <tr style="background: #fff; color: #23233a;">
                    <th><input type="checkbox" id="selectAll">
                    </th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>ID No.</th>
                    <th>Apartment</th>
                    <th>Unit</th>
                    <th>Joined At</th>
                    <th>Agreement</th>
                    <th>Scanned ID</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tenants as $index => $tenant)
                    <tr style="background: #fff; color: #23233a;">
                        <td>
                        <input type="checkbox" class="row-checkbox" value="{{ $tenant->id }}" data-id="{{ $tenant->id }}">

                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $tenant->name }}</td>
                        <td>{{ $tenant->phone }}</td>
                        <td>{{ $tenant->email }}</td>
                        <td>{{ $tenant->id_number }}</td>
                        <td>{{ $tenant->apartment->name ?? '—' }}</td>
                        <td>{{ $tenant->houseUnit->unit_label ?? '—' }}</td>
                        <td>{{ $tenant->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($tenant->tenancy_agreement)
                                <a href="{{ asset('storage/' . $tenant->tenancy_agreement) }}" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($tenant->scanned_id)
                                <a href="{{ asset('storage/' . $tenant->scanned_id) }}" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $tenant->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr style="background: #fff; color: #23233a;">
                        <td colspan="12" class="text-center">No tenants found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Notify Modal -->
<div class="modal fade" id="notifyModal" tabindex="-1" aria-labelledby="notifyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="background: #fff; color: #23233a; border-radius: 16px; box-shadow: 0 4px 24px rgba(20,20,40,0.12); border: none;">
      <div class="modal-header" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); border-top-left-radius: 16px; border-top-right-radius: 16px; border-bottom: none; color: #fff;">
        <h5 class="modal-title" id="notifyModalLabel">Notify via Email / SMS</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="notifyForm" method="POST" action="{{ route('admin.tenants.notify.bulk') }}">
          @csrf
          <input type="hidden" name="tenant_ids" id="notifyTenantIds">

          <div class="mb-3">
            <label for="subject" class="form-label">Message Subject (Email):</label>
            <input type="text" id="subject" name="subject" class="form-control" placeholder="e.g Happy Birthday!" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px;">
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Text Message (Email & SMS):</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="e.g. Hey [firstname], ..." style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px;"></textarea>
          </div>

          <div class="form-check mb-2 d-flex align-items-center">
  <input type="checkbox" id="sendEmail" name="send_email" value="1"
         class="form-check-input"
         style="width: 18px; height: 18px; background-color: white; border: 1px solid #ccc; appearance: auto; margin-right: 8px;">
  <label class="form-check-label text-white" for="sendEmail">Send Email</label>
</div>

<div class="form-check mb-3 d-flex align-items-center">
  <input type="checkbox" id="sendSms" name="send_sms" value="1"
         class="form-check-input"
         style="width: 18px; height: 18px; background-color: white; border: 1px solid #ccc; appearance: auto; margin-right: 8px;">
  <label class="form-check-label text-white" for="sendSms">Send SMS</label>
</div>






          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success px-4">Submit</button>
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Create Invoice Modal (Force Visible) -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="invoiceForm" method="POST" action="{{ route('admin.tenants.invoices.bulk') }}">
      @csrf
      <div class="modal-content" style="background: #fff; color: #23233a; border-radius: 16px; box-shadow: 0 4px 24px rgba(20,20,40,0.12); border: none;">
        <div class="modal-header" style="background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%); border-top-left-radius: 16px; border-top-right-radius: 16px; border-bottom: none; color: #fff;">
          <h5 class="modal-title" id="invoiceModalLabel">Create Invoice</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>This action will create an invoice for all the selected Tenants.</p>
          <div class="mb-3">
            <label for="due_date" class="form-label">Invoice Due Date</label>
            <input type="date" class="form-control" name="due_date" id="due_date" style="background: #fff; border: 1px solid #e5e7eb; color: #23233a; border-radius: 8px;" required>
          </div>
          <input type="hidden" name="tenant_ids" id="invoiceTenantIds">
        </div>
        <div class="modal-footer" style="border-top: 1px solid #444;">
          <button type="submit" class="btn btn-success">Yes, Proceed</button>
          <button type="button" class="btn" style="background: #fff; color: #ff7e5f; border: 2px solid #ff7e5f; border-radius: 8px; font-weight: 600; font-size: 1rem; padding: 10px 22px; box-shadow: 0 2px 8px rgba(20,20,40,0.08); transition: background 0.2s;" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
 





@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const deselectLink = document.getElementById('deselect-all');
    const selectedCount = document.getElementById('selected-count');
    const bulkBar = document.getElementById('bulk-actions-bar');
    const invoiceTenantIdsInput = document.getElementById('invoiceTenantIds');
    const invoiceModal = document.getElementById('invoiceModal');

    // Update counter + show/hide bulk bar
    function updateBulkUI() {
        const selected = document.querySelectorAll('.row-checkbox:checked');
        selectedCount.innerText = selected.length;
        bulkBar.classList.toggle('d-none', selected.length === 0);
    }

    // Select All
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateBulkUI();
        });
    }

    // Each row checkbox
    checkboxes.forEach(cb => cb.addEventListener('change', updateBulkUI));

    // Deselect all
    deselectLink?.addEventListener('click', function (e) {
        e.preventDefault();
        checkboxes.forEach(cb => cb.checked = false);
        selectAll.checked = false;
        updateBulkUI();
    });

    // When modal opens
    invoiceModal.addEventListener('show.bs.modal', function () {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);

        if (selectedIds.length === 0) {
            alert('Please select at least one tenant.');
            const modalInstance = bootstrap.Modal.getInstance(invoiceModal);
            modalInstance.hide();
            return;
        }

        invoiceTenantIdsInput.value = selectedIds.join(',');
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleNewTenantForm');
    const form = document.getElementById('newTenantForm');

    toggleBtn.addEventListener('click', function () {
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtn = document.getElementById('toggleFilters');
    const filterSidebar = document.getElementById('filterSidebar');

    filterBtn?.addEventListener('click', function () {
        if (filterSidebar.style.display === 'none' || filterSidebar.style.display === '') {
            filterSidebar.style.display = 'block';
        } else {
            filterSidebar.style.display = 'none';
        }
    });
});
</script>
 
<script>
document.addEventListener('DOMContentLoaded', function () {
    const notifyBtn = document.getElementById('notifyBtn');
    const notifyModal = new bootstrap.Modal(document.getElementById('notifyModal'));
    const notifyTenantIdsInput = document.getElementById('notifyTenantIds');

    notifyBtn?.addEventListener('click', function () {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
        if (selectedIds.length === 0) {
            alert('Please select at least one tenant.');
            return;
        }
        notifyTenantIdsInput.value = selectedIds.join(',');
        notifyModal.show();
    });
});
</script>





@endpush
