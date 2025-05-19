<!-- resources/views/admin/roles/index-panel.blade.php -->

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Roles</h2>
                <p class="text-sm text-gray-500 mt-1">Manage user roles and permissions</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.roles.create') }}" 
                   class="ajax-nav flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Role
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Role Name</th>
                    <th class="px-6 py-3 text-left">Permissions</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach($roles as $role)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $role->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $role->permissions_count }} Permissions</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.roles.edit', $role->id) }}" 
                           class="ajax-nav text-orange-600 hover:text-orange-900 font-medium text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline" data-ajax>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-gray-200">
        {{ $roles->links('vendor.pagination.tailadmin') }}
    </div>
</div>
