<form method="POST"
      action="{{ isset($role)
                   ? route('admin.roles.update', $role->id)
                   : route('admin.roles.store') }}">
  @csrf
  @if(isset($role))
    @method('PUT')
  @endif

  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name"
           value="{{ $role->name ?? '' }}"
           class="form-control" placeholder="Role name">
  </div>

  <div class="form-group">
    <label>Permissions</label>
    <div class="row">
      @foreach($permissions as $perm)
        <div class="col-md-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox"
                   name="permissions[]" value="{{ $perm->id }}"
                   {{ (isset($role) && $role->hasPermissionTo($perm->name)) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $perm->name }}</label>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="text-right">
    <button type="submit" class="btn btn-primary">
      {{ isset($role) ? 'Update Role' : 'Create Role' }}
    </button>
  </div>
</form>