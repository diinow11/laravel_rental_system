<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 lg:left-64">
    <div class="px-6 py-4 flex items-center justify-between">

        <!-- Left: Hamburger on Mobile -->
        <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Page Title (dynamic) -->
            <h1 class="text-xl font-semibold text-gray-700">
                @yield('title', 'Dashboard')
            </h1>
        </div>

        <!-- Right: Profile dropdown -->
        <div class="relative">
            <button id="profileDropdownButton" class="flex items-center gap-2 rounded-lg p-2 hover:bg-gray-100 focus:outline-none">
                <img class="w-8 h-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" alt="User Avatar">
                <span class="text-gray-700 text-sm font-medium">Admin User</span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>

<script>
    // Toggle Profile Dropdown
    const dropdownButton = document.getElementById('profileDropdownButton');
    const dropdownMenu = document.getElementById('profileDropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Toggle Sidebar on Mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
