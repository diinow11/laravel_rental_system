<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Lease;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usersCount = User::count();
        $propertiesCount = Property::count();
        $leasesCount = Lease::count();
        $employeesCount = Employee::count();
        $latestUsers = User::latest()->take(5)->get();

        return view('admin.dashboard.index_new', compact(
            'usersCount',
            'propertiesCount',
            'leasesCount',
            'employeesCount',
            'latestUsers'
        ));
    }
    public function chartData()
    {
        // Users by Month
        $usersMonthly = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
    
        // Properties and Leases Counts
        $propertiesCount = Property::count();
        $leasesCount = Lease::count();
    
        return response()->json([
            'usersMonthly' => $usersMonthly,
            'propertiesCount' => $propertiesCount,
            'leasesCount' => $leasesCount,
        ]);
    }

}
