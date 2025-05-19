@extends('admin.layouts.admin_new')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Dashboard specific styles */
    .chart-card {
        height: 340px;
    }
    
    .stat-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
        border-radius: 16px;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.1);
    }
    
    /* Subtle pattern background */
    .pattern-bg {
        position: relative;
    }
    
    .pattern-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(67, 97, 238, 0.03)' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.7;
        pointer-events: none;
    }
    
    /* Improved card styles */
    .enhanced-card {
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 15px -3px rgba(67, 97, 238, 0.05), 0 4px 6px -2px rgba(67, 97, 238, 0.025);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
    }
    
    .enhanced-card:hover {
        box-shadow: 0 20px 25px -5px rgba(67, 97, 238, 0.1), 0 10px 10px -5px rgba(67, 97, 238, 0.04);
        transform: translateY(-3px);
    }
    
    /* Modern stat cards */
    .stat-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        font-size: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(67, 97, 238, 0.08), 0 4px 6px -2px rgba(67, 97, 238, 0.03);
    }
    
    /* Trend indicators */
    .trend-up {
        color: var(--success-color);
        background-color: rgba(44, 182, 125, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .trend-down {
        color: var(--danger-color);
        background-color: rgba(230, 57, 70, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Welcome banner */
    :root {
    --primary-color: #2563eb;        /* blue-600 */
    --primary-dark: #1e40af;         /* blue-800 */
    --secondary-color: #38bdf8;      /* sky-400 */
    --accent-color: #818cf8;         /* indigo-400 */
    --success-color: #22d3ee;        /* teal-400 */
    --warning-color: #fde68a;        /* yellow-200 */
    --danger-color: #f87171;         /* red-400 */
    --info-color: #38bdf8;           /* sky-400 */
    --gradient-main: linear-gradient(120deg, #2563eb 0%, #38bdf8 100%);
    --gradient-accent: linear-gradient(120deg, #818cf8 0%, #38bdf8 100%);
    --gradient-success: linear-gradient(120deg, #22d3ee 0%, #38bdf8 100%);
    --gradient-warning: linear-gradient(120deg, #fde68a 0%, #fbbf24 100%);
    --gradient-danger: linear-gradient(120deg, #f87171 0%, #fbbf24 100%);
}

    .welcome-banner {
    background: var(--gradient-main);
    border-radius: 16px;
    border: 1px solid rgba(37, 99, 235, 0.10);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    color: #fff;
    box-shadow: 0 6px 32px 0 rgba(37, 99, 235, 0.09);
    background-blend-mode: lighten;
}
.welcome-banner h1, .welcome-banner p {
    color: #f1f5f9;
}

    
    /* Animated elements */
    .fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Staggered animations */
    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    .stagger-4 { animation-delay: 0.4s; }
    
    /* Table styles */
    .table-row {
        transition: all 0.2s ease;
    }
    
    .table-row:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }
    
    /* Status badges */
    .status-badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
    }
    
    .status-upcoming {
    background: var(--gradient-accent);
    color: #fff;
    box-shadow: 0 2px 8px 0 rgba(129, 140, 248, 0.08);
}

    
    .status-overdue {
    background: var(--gradient-danger);
    color: #fff;
    box-shadow: 0 2px 8px 0 rgba(248, 113, 113, 0.08);
}

    
    .status-paid {
    background: var(--gradient-success);
    color: #fff;
    box-shadow: 0 2px 8px 0 rgba(34, 211, 238, 0.08);
}

</style>
@endsection

@section('content')
<!-- Modern Welcome Banner -->
<div class="welcome-banner fade-in-up mb-6" style="margin-top:0;">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-white rounded-2xl shadow-sm">
                <i class="fas fa-chart-line text-2xl text-primary-color"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Welcome back, Admin!</h1>
                <p class="text-gray-500 mt-1">Here's what's happening with your properties today</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</div>
            <div class="px-3 py-1 bg-primary-color text-white text-sm font-medium rounded-full shadow-sm">
                System Administrator
            </div>
        </div>
    </div>
</div>

<!-- Statistics Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Properties -->
    <div class="bg-white p-6 stat-card enhanced-card pattern-bg fade-in-up stagger-1">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-600 text-sm font-medium">Total Properties</h3>
            <div class="stat-icon bg-blue-50 text-primary-color">
                <i class="fas fa-building"></i>
            </div>
        </div>
        <div class="flex items-end space-x-3">
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalProperties ?? 24 }}</h2>
            <span class="trend-up flex items-center">
                <i class="fas fa-arrow-up mr-1"></i>
                8.3%
            </span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <p class="text-gray-500 text-sm">Since last month</p>
            <div class="h-1 w-24 bg-gray-100 rounded overflow-hidden">
                <div class="h-full bg-primary-color" style="width: 75%"></div>
            </div>
        </div>
    </div>
    
    <!-- Total Tenants -->
    <div class="bg-white p-6 stat-card enhanced-card pattern-bg fade-in-up stagger-2">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-600 text-sm font-medium">Total Tenants</h3>
            <div class="stat-icon bg-purple-50 text-accent-color">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="flex items-end space-x-3">
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalTenants ?? 86 }}</h2>
            <span class="trend-up flex items-center">
                <i class="fas fa-arrow-up mr-1"></i>
                12.5%
            </span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <p class="text-gray-500 text-sm">Since last month</p>
            <div class="h-1 w-24 bg-gray-100 rounded overflow-hidden">
                <div class="h-full bg-accent-color" style="width: 85%"></div>
            </div>
        </div>
    </div>
    
    <!-- Total Revenue -->
    <div class="bg-white p-6 stat-card enhanced-card pattern-bg fade-in-up stagger-3">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-600 text-sm font-medium">Monthly Revenue</h3>
            <div class="stat-icon bg-green-50 text-success-color">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <div class="flex items-end space-x-3">
            <h2 class="text-3xl font-bold text-gray-800">${{ number_format($monthlyRevenue ?? 45250) }}</h2>
            <span class="trend-up flex items-center">
                <i class="fas fa-arrow-up mr-1"></i>
                5.2%
            </span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <p class="text-gray-500 text-sm">Since last month</p>
            <div class="h-1 w-24 bg-gray-100 rounded overflow-hidden">
                <div class="h-full bg-success-color" style="width: 65%"></div>
            </div>
        </div>
    </div>
    
    <!-- Vacancies -->
    <div class="bg-white p-6 stat-card enhanced-card pattern-bg fade-in-up stagger-4">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-600 text-sm font-medium">Vacant Units</h3>
            <div class="stat-icon bg-amber-50 text-warning-color">
                <i class="fas fa-door-open"></i>
            </div>
        </div>
        <div class="flex items-end space-x-3">
            <h2 class="text-3xl font-bold text-gray-800">{{ $vacantUnits ?? 8 }}</h2>
            <span class="trend-down flex items-center">
                <i class="fas fa-arrow-down mr-1"></i>
                2.3%
            </span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <p class="text-gray-500 text-sm">Since last month</p>
            <div class="h-1 w-24 bg-gray-100 rounded overflow-hidden">
                <div class="h-full bg-warning-color" style="width: 25%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Right Column -->
    <div class="space-y-6">
        <!-- Occupancy Rate -->
        <div class="bg-white p-6 enhanced-card pattern-bg fade-in-up stagger-2">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">Occupancy Rate</h3>
                    <p class="text-xs text-gray-500 mt-1">Last 30 days performance</p>
                </div>
                <div class="px-2 py-1 bg-blue-50 text-primary-color text-xs font-medium rounded-md border border-blue-100">
                    <i class="fas fa-chart-pie mr-1"></i> Statistics
                </div>
            </div>
            <div class="flex items-center justify-center py-4">
                <div class="relative w-44 h-44">
                    <div id="occupancyChart" class="absolute top-0 left-0 w-full h-full"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-gray-800">{{ $occupancyRate ?? '92%' }}</span>
                        <span class="text-sm text-gray-500">Occupancy</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div class="p-3 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-xs text-gray-500">Occupied</div>
                            <div class="text-lg font-bold text-gray-800">{{ $occupiedUnits ?? 92 }}</div>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-primary-color">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-xs text-gray-500">Vacant</div>
                            <div class="text-lg font-bold text-gray-800">{{ $vacantUnits ?? 8 }}</div>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="bg-white p-6 enhanced-card pattern-bg fade-in-up stagger-3">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">Recent Activities</h3>
                    <p class="text-xs text-gray-500 mt-1">Latest system updates</p>
                </div>
                <a href="#" class="text-primary-color text-sm font-medium hover:underline flex items-center">
                    View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-start p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-green-100 text-success-color mr-3 shadow-sm">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Payment received from <span class="font-medium text-primary-color">John Doe</span></p>
                        <p class="text-xs text-gray-500 mt-1">10 minutes ago</p>
                    </div>
                    <div class="text-success-color font-medium">
                        +$1,200
                    </div>
                </div>
                
                <div class="flex items-start p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-100 text-primary-color mr-3 shadow-sm">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">New tenant <span class="font-medium text-primary-color">Lisa Johnson</span> moved in</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-red-100 text-danger-color mr-3 shadow-sm">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Maintenance request by <span class="font-medium text-primary-color">Mike Smith</span></p>
                        <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Row -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Upcoming Payments -->
    <div class="bg-white p-6 enhanced-card pattern-bg fade-in-up">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-semibold text-lg text-gray-800">Upcoming Payments</h3>
                <p class="text-xs text-gray-500 mt-1">Next 30 days schedule</p>
            </div>
            <a href="#" class="text-primary-color text-sm font-medium hover:underline flex items-center">
                View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenant</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="table-row hover:bg-gray-50 transition-colors">
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-9 w-9 rounded-lg bg-blue-100 flex items-center justify-center text-primary-color shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                    <div class="text-xs text-gray-500">john@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">Apt 101</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$1,200</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">May 31, 2025</td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="status-badge status-upcoming">Upcoming</span>
                        </td>
                    </tr>
                    <tr class="table-row hover:bg-gray-50 transition-colors">
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-9 w-9 rounded-lg bg-purple-100 flex items-center justify-center text-accent-color shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                    <div class="text-xs text-gray-500">jane@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">Apt 205</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$950</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">May 29, 2025</td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="status-badge status-overdue">Overdue</span>
                        </td>
                    </tr>
                    <tr class="table-row hover:bg-gray-50 transition-colors">
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-9 w-9 rounded-lg bg-green-100 flex items-center justify-center text-success-color shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Michael Johnson</div>
                                    <div class="text-xs text-gray-500">michael@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">Apt 310</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$1,500</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-600">June 1, 2025</td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="status-badge status-paid">Paid</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Maintenance Requests -->
    <div class="bg-white p-6 enhanced-card pattern-bg fade-in-up">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-semibold text-lg text-gray-800">Maintenance Requests</h3>
                <p class="text-xs text-gray-500 mt-1">Recent maintenance tickets</p>
            </div>
            <a href="#" class="text-primary-color text-sm font-medium hover:underline flex items-center">
                View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
        <div class="space-y-4">
            <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1 bg-white">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-xl bg-red-100 flex items-center justify-center text-danger-color mr-3 shadow-sm">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Leaking Faucet</h4>
                            <p class="text-xs text-gray-500 mt-1">Apt 101 - John Doe</p>
                        </div>
                    </div>
                    <span class="px-2.5 h-6 flex items-center text-xs font-medium rounded-full bg-red-100 text-danger-color">High</span>
                </div>
                <div class="mt-3 text-sm text-gray-600">
                    <p>The bathroom faucet has been leaking for two days now and getting worse.</p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Submitted: May 15, 2025</span>
                    <button class="px-3 py-1.5 text-xs bg-gradient-to-r from-primary-color to-primary-dark text-white rounded-lg shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5 font-medium">
                        Assign <i class="fas fa-user-plus ml-1"></i>
                    </button>
                </div>
            </div>
            
            <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1 bg-white">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-xl bg-amber-100 flex items-center justify-center text-warning-color mr-3 shadow-sm">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Power Outage</h4>
                            <p class="text-xs text-gray-500 mt-1">Apt 205 - Jane Smith</p>
                        </div>
                    </div>
                    <span class="px-2.5 h-6 flex items-center text-xs font-medium rounded-full bg-amber-100 text-warning-color">Medium</span>
                </div>
                <div class="mt-3 text-sm text-gray-600">
                    <p>The power keeps going out in the kitchen when using the microwave.</p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Submitted: May 16, 2025</span>
                    <button class="px-3 py-1.5 text-xs bg-gradient-to-r from-primary-color to-primary-dark text-white rounded-lg shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5 font-medium">
                        Assign <i class="fas fa-user-plus ml-1"></i>
                    </button>
                </div>
            </div>
            
            <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1 bg-white">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-xl bg-blue-100 flex items-center justify-center text-primary-color mr-3 shadow-sm">
                            <i class="fas fa-snowflake"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">AC Not Working</h4>
                            <p class="text-xs text-gray-500 mt-1">Apt 310 - Michael Johnson</p>
                        </div>
                    </div>
                    <span class="px-2.5 h-6 flex items-center text-xs font-medium rounded-full bg-blue-100 text-primary-color">Low</span>
                </div>
                <div class="mt-3 text-sm text-gray-600">
                    <p>The air conditioning unit is not cooling properly.</p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Submitted: May 17, 2025</span>
                    <div class="px-3 py-1.5 text-xs bg-gray-100 text-gray-700 rounded-lg font-medium">
                        <i class="fas fa-user-check mr-1"></i> Assigned to Joe
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        var revenueOptions = {
            series: [{
                name: 'Revenue',
                data: [42500, 44800, 43200, 47500, 45250, 46800, 48500, 49200, 50500, 51200, 52800, 54000]
            }, {
                name: 'Expenses',
                data: [22500, 23800, 24200, 23500, 25000, 23800, 24500, 25200, 26500, 25200, 26800, 27000]
            }],
            chart: {
                type: 'area',
                height: 280,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                fontFamily: 'Inter, Segoe UI, sans-serif',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#4361ee', '#2cb67d'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '12px',
                        fontFamily: 'Inter, Segoe UI, sans-serif',
                        fontWeight: 500
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '12px',
                        fontFamily: 'Inter, Segoe UI, sans-serif',
                        fontWeight: 500
                    },
                    formatter: function(val) {
                        return '$' + val.toLocaleString();
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return '$' + val.toLocaleString();
                    }
                },
                theme: 'light',
                style: {
                    fontSize: '12px',
                    fontFamily: 'Inter, Segoe UI, sans-serif'
                }
            },
            grid: {
                borderColor: '#e2e8f0',
                strokeDashArray: 5,
                padding: {
                    left: 10
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -15,
                fontSize: '13px',
                fontFamily: 'Inter, Segoe UI, sans-serif',
                fontWeight: 500,
                markers: {
                    width: 12,
                    height: 12,
                    radius: 6
                },
                itemMargin: {
                    horizontal: 10
                }
            }
        };

        var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
        revenueChart.render();

        // Occupancy Chart
        var occupancyOptions = {
            series: [92],
            chart: {
                height: 180,
                type: 'radialBar',
                offsetY: 0,
                fontFamily: 'Inter, Segoe UI, sans-serif',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    }
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#f1f5f9',
                        strokeWidth: '97%',
                        margin: 0,
                        dropShadow: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            show: false
                        }
                    },
                    hollow: {
                        size: '60%'
                    },
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#3a56d4'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: 'round'
            },
            colors: ['#4361ee']
        };

        var occupancyChart = new ApexCharts(document.querySelector("#occupancyChart"), occupancyOptions);
        occupancyChart.render();
    });
</script>
@endpush --}}
