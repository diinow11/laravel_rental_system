{{-- CASCADE_MARKER_ROLES_GLOBAL --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">Roles</h2>

@section('content')

<button class="btn btn-primary mb-3" onclick="document.getElementById('roleForm').classList.toggle('d-none')">
    + New Role
</button>



<div class="container-fluid">
    <h1 class="mb-4 text-white">Roles Management</h1>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    {{-- Add Role Form --}}
    <div id="roleForm" class="d-none">
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="roleName" class="form-label text-light">Role Name</label>
            <input type="text" name="name" id="roleName" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label text-light fw-bold">Permissions</label>

            @php
    $groupedPermissions = [];

    foreach ($permissions as $permission) {
        $parts = explode('.', $permission->name);
        $group = ucfirst($parts[0] ?? 'Other');
        $label = ucfirst($parts[1] ?? 'Unnamed');

        $groupedPermissions[$group][] = [
            'id' => $permission->id,
            'label' => $label
        ];
    }
@endphp

@forelse ($groupedPermissions as $group => $groupPermissions)
    <div class="mt-3">
        <div class="fw-bold text-light mb-2">{{ $group }}</div>
        <div class="row">
            @foreach ($groupPermissions as $permission)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="permissions[]" value="{{ $permission['id'] }}"
                               id="perm_{{ $permission['id'] }}">
                        <label class="form-check-label text-light"
                               for="perm_{{ $permission['id'] }}">
                            {{ $permission['label'] }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <p class="text-danger">No permissions found.</p>
@endforelse

        </div>

        <button type="submit" class="btn btn-success">Create Role</button>
    </form>
</div>

    {{-- Roles List --}}
    <div class="card bg-dark text-white">
        <div class="card-header">All Roles</div>
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
    {{ $role->permissions->count() }} permission{{ $role->permissions->count() !== 1 ? 's' : '' }}
</td>

                            <td>
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($roles->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No roles created yet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
input[type="checkbox"].form-check-input {
    opacity: 1 !important;
    visibility: visible !important;
    display: inline-block !important;
    width: 1.25rem !important;
    height: 1.25rem !important;
    transform: scale(1) !important;
    margin-top: 0.3rem;
    margin-left: 0;
    background-color: #fff;
}
</style>

@endsection
