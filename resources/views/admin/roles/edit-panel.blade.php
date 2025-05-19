<!-- resources/views/admin/roles/edit-panel.blade.php -->

<div class="bg-white rounded-xl shadow-sm border border-gray-200 max-w-3xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Edit Role</h2>
        <p class="text-sm text-gray-500 mt-1">Update role information and permissions</p>
    </div>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" data-ajax class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6">
            <!-- Role Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Role Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}" required
                       class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                              @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Permissions -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Assign Permissions <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-64 overflow-y-auto">
                    @foreach($permissions as $permission)
                        <label class="flex items-center space-x-2 text-sm text-gray-700">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}
                                   class="text-orange-500 border-gray-300 rounded focus:ring-orange-500">
                            <span>{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.roles.index') }}" 
               class="ajax-nav px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors text-sm font-medium">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors text-sm font-medium">
                Update Role
            </button>
        </div>
    </form>
</div>
