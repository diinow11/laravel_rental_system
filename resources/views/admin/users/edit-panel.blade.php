<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit User: {{ $user->name }}</h2>
    
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" data-ajax>
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    User Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ $user->name }}" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ $user->email }}" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password (leave blank to keep current)
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    User Role <span class="text-red-500">*</span>
                </label>
                <select name="roles[]" multiple required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 h-32">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 ajax-nav">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-white hover:bg-orange-700">
                    Update User
                </button>
            </div>
        </div>
    </form>
</div>