{{-- CASCADE_MARKER_USERS_GLOBAL --}}
@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <h2 style="margin-bottom: 24px; color: #fff;">Users</h2>

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-light">Users</h2>
    <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
    + New Users
</button>
</div>



{{-- Table --}}
<div class="table-responsive bg-dark p-3 rounded">
    <table class="table table-dark table-bordered table-striped align-middle mb-0">
        <thead class="table-secondary text-dark">
            <tr>
                <th>User Name</th>
                <th>User Email Address</th>
                <th>Role</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->first() ?? '—' }}</td>
                    <td class="text-center">
                        <a href="#" class="text-warning me-2">✏️ Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content bg-dark text-light">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Add a New User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="name" class="form-label">User Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="e.g. John Kamau" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">User Role</label>
          <select name="role" id="role" class="form-select" required>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('newUserBtn').addEventListener('click', function () {
        let modal = new bootstrap.Modal(document.getElementById('newUserModal'));
        modal.show();
    });
</script>
@endsection
