{{-- resources/views/livewire/admin/roles-index.blade.php --}}
<div class="space-y-6">
  {{-- Page header --}}
  <div class="flex justify-between items-center">
    <h1 class="text-2xl font-semibold">System Users & Roles</h1>
    <a href="{{ route('admin.roles.create') }}"
       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
      <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
      </svg>
      New Role
    </a>
  </div>

  {{-- Roles table card --}}
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"># Permissions</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Updated</th>
          <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($roles as $role)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($role->name) }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $role->permissions_count }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $role->updated_at->format('Y-m-d') }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <a href="{{ route('admin.roles.edit', $role) }}"
                 class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
              <form action="{{ route('admin.roles.destroy', $role) }}"
                    method="POST"
                    class="inline"
                    onsubmit="return confirm('Really delete this role?');">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
              No roles found.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- Pagination --}}
    <div class="px-6 py-3 bg-gray-50 text-right">
      {{ $roles->links() }}
    </div>
  </div>
</div>

