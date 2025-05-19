{{-- resources/views/admin/layout/_topbar.blade.php --}}
<nav class="bg-white border-b border-gray-100 shadow-sm h-16 flex items-center justify-between px-6" style="background: var(--topbar-bg); border-bottom: 1px solid var(--topbar-border);">
    <div class="flex items-center">
        <h1 class="text-lg font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Search -->
        <div class="relative">
            <input type="text" class="bg-gray-50 border border-gray-200 rounded-full py-2 pl-10 pr-4 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-primary-light focus:bg-white transition-all" placeholder="Search...">
            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
        </div>
        <!-- Notifications -->
        <div class="relative">
            <button class="p-2 text-gray-500 hover:text-primary-color hover:bg-primary-light/10 rounded-full transition-colors relative">
                <i class="fas fa-bell"></i>
                <span class="absolute top-0 right-0 h-2 w-2 bg-secondary-color rounded-full pulse"></span>
            </button>
        </div>
        <!-- User menu -->
        <div class="relative">
            <button class="flex items-center space-x-2 text-gray-700 hover:text-primary-color focus:outline-none">
                <div class="w-9 h-9 rounded-full bg-gradient-to-r from-primary-color to-accent-color text-white flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-xs"></i>
                </div>
                <span class="text-sm font-medium hidden md:inline-block">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <!-- Dropdown menu (hidden by default) -->
            <div class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-1 z-50 border border-gray-100 w-48">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-user-circle mr-2 text-primary-color"></i> Your Profile
                </a>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-cog mr-2 text-primary-color"></i> Settings
                </a>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-question-circle mr-2 text-primary-color"></i> Help Center
                </a>
                <div class="border-t border-gray-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2 text-secondary-color"></i> Sign out
                    </button>
                </form>
            </div>
        </div>
        <!-- Theme Selector Button -->
        <button class="open-theme-modal ml-4 bg-primary-color text-white px-3 py-2 rounded-full shadow hover:bg-primary-dark transition-all flex items-center gap-2">
            <i class="fas fa-palette"></i> Theme
        </button>
    </div>
</nav>