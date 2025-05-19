<!-- Professional Sidebar -->
<aside class="w-24 h-screen border-r border-gray-100 flex flex-col py-4 fixed top-0 left-0 z-10 shadow-sm" style="background: var(--sidebar-bg);">
    <!-- Logo Area -->
    <div class="flex justify-center mb-6 mt-2">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-color to-accent-color flex items-center justify-center text-white shadow-lg">
            <i class="fas fa-building text-xl"></i>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex flex-col space-y-1 w-full px-3">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center py-3 text-primary-color hover:text-white hover:bg-var(--sidebar-active) rounded-xl transition-all duration-200 group relative">
            <div class="absolute left-0 w-1 h-8 bg-var(--sidebar-active) rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-home text-lg mb-1.5"></i>
            <span class="text-xs font-medium">Dashboard</span>
        </a>
        
        <!-- Tenants -->
        <a href="{{ route('admin.tenants.index') }}" class="flex flex-col items-center py-3 text-gray-500 hover:text-white hover:bg-var(--sidebar-hover) rounded-xl transition-all duration-200 group relative">
            <div class="absolute left-0 w-1 h-8 bg-var(--sidebar-active) rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-users text-lg mb-1.5"></i>
            <span class="text-xs font-medium">Tenants</span>
        </a>
        
        <!-- Payments -->
        <a href="{{ route('admin.rent-payments.index') }}" class="flex flex-col items-center py-3 text-gray-500 hover:text-white hover:bg-var(--sidebar-hover) rounded-xl transition-all duration-200 group relative">
            <div class="absolute left-0 w-1 h-8 bg-var(--sidebar-active) rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-money-bill-wave text-lg mb-1.5"></i>
            <span class="text-xs font-medium">Payments</span>
        </a>
        
        <!-- Properties -->
        <a href="{{ route('admin.apartments.index') }}" class="flex flex-col items-center py-3 text-gray-500 hover:text-white hover:bg-var(--sidebar-hover) rounded-xl transition-all duration-200 group relative">
            <div class="absolute left-0 w-1 h-8 bg-var(--sidebar-active) rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-building text-lg mb-1.5"></i>
            <span class="text-xs font-medium">Properties</span>
        </a>
        
        <!-- Administration -->
        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center py-3 text-gray-500 hover:text-white hover:bg-var(--sidebar-hover) rounded-xl transition-all duration-200 group relative">
            <div class="absolute left-0 w-1 h-8 bg-var(--sidebar-active) rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-cog text-lg mb-1.5"></i>
            <span class="text-xs font-medium">Admin</span>
        </a>
    </nav>
    
    <!-- Bottom Section -->
    <div class="mt-auto flex flex-col items-center pb-4">
        <a href="#" class="flex flex-col items-center py-3 text-gray-500 hover:text-primary-color hover:bg-primary-light/10 rounded-xl transition-all duration-200 w-full">
            <i class="fas fa-question-circle text-lg mb-1"></i>
            <span class="text-xs font-medium">Help</span>
        </a>
        <!-- Theme Selector Button -->
        <button class="open-theme-modal mt-4 w-12 h-12 flex items-center justify-center rounded-full bg-primary-color text-white shadow hover:bg-primary-dark transition-all" title="Theme">
            <i class="fas fa-palette text-xl"></i>
        </button>
    </div>
</aside>
