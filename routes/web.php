<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use App\Mail\TenantNotification;
use Illuminate\Support\Facades\Mail;
use AfricasTalking\SDK\AfricasTalking;



// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\GatewayPaymentController;
use App\Http\Controllers\Admin\PaymentModeController;
use App\Http\Controllers\Admin\PaymentReceiptController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\HouseUnitController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SMSCallbackController;

use App\Http\Controllers\Admin\RentPaymentController;
use App\Http\Controllers\Tenant\Auth\TenantAuthController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Tenant\PaymentController;
use App\Http\Controllers\MpesaController;



Route::post('/api/mpesa/stkpush', [MpesaController::class, 'stkPush']);
Route::post('/api/mpesa/callback', [MpesaController::class, 'mpesaCallback']);


// ─────────────────────────────────────────────────────────────────────────────
// Public routes
Route::view('/', 'auth.login1')->name('login1');
Route::view('/register1', 'auth.register1')->name('register1');

Auth::routes();

// ─────────────────────────────────────────────────────────────────────────────
// Default redirect after login

Route::prefix('tenant')->name('tenant.')->group(function () {
    Route::get('login', [TenantAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [TenantAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [TenantAuthController::class, 'logout'])->name('logout');
    

    Route::middleware('auth:tenant')->group(function () {
        Route::get('dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');
        Route::post('pay', [TenantDashboardController::class, 'pay'])->name('pay');
        Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');

    });
});

// ─────────────────────────────────────────────────────────────────────────────
// Admin-protected routes
Route::middleware([Authenticate::class])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart-data', [AdminDashboardController::class, 'chartData'])->name('dashboard.chart-data');
    // Apartments
    Route::get('/apartments/create', function() {
        return view('admin.apartments.create');
    })->name('apartments.create');

    // Tenants
    Route::resource('tenants', TenantController::class)->only(['index', 'create', 'store']);
    Route::post('tenants/invoices/bulk', [TenantController::class, 'bulkCreateInvoices'])->name('tenants.invoices.bulk');
    Route::post('/tenants/notify/bulk', [TenantController::class, 'sendNotification'])->name('tenants.notify.bulk');
   



    Route::post('/tenants/notify', [TenantController::class, 'notify'])->name('tenants.notify');


   
    


    // Invoices
    Route::get('invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', function() {
        return view('admin.invoices.create');
    })->name('invoices.create');
    Route::post('invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'store'])->name('invoices.store');
 




    // Payments
  
    Route::resource('rent-payments', RentPaymentController::class)->only(['index', 'store']);
    Route::resource('gateway-payments', GatewayPaymentController::class)->only(['index']);
    Route::resource('payment-modes', PaymentModeController::class)->only(['index']);
    Route::resource('payment-receipts', PaymentReceiptController::class)->only(['index']);

    // Apartments & House Units
    Route::resource('apartments', ApartmentController::class)->only(['index', 'store']);
    Route::resource('house-units', HouseUnitController::class)->only(['index', 'store']);

    // Admin
    Route::resource('roles', RoleController::class)->only(['index', 'store', 'destroy']);
    
    Route::resource('users', UserController::class)->only(['index', 'store', 'destroy']);
});

Route::get('/test-email', function () {
    Mail::to('your@gmail.com')->send(new TenantNotification('Test Subject', 'This is a test message.'));
    return 'Test email sent';
});

Route::post('/sms/status', [SMSCallbackController::class, 'handle']);


