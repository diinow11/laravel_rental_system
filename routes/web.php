<?php

use App\Http\Middleware\Authenticate;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adminController;
use App\Http\Controllers\propertiesController;
use App\Http\Controllers\leasesController;
use App\Http\Controllers\locationsController;
use App\Http\Controllers\emailsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'login1');
Route::view('/', 'auth.login1')->name('login1');
Route::view('/register1', 'auth.register1')->name('register1');

Auth::routes();

// Admin Routes
Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('Dashboard')->middleware('auth');

Route::post('/locations/store', [App\Http\Controllers\locationsController::class, 'store']);



Route::middleware([Authenticate::class])->group(function () {

    // Properties
    Route::prefix('properties')->group(function () {
        Route::get('/', [App\Http\Controllers\propertiesController::class, 'index'])->name('properties');
        Route::get('/create', [App\Http\Controllers\propertiesController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\propertiesController::class, 'store'])->name('create.property');
        Route::get('/delete/{pid}', [App\Http\Controllers\propertiesController::class, 'destroy']);
        Route::get('/edit/{pid}', [App\Http\Controllers\propertiesController::class, 'edit']);
        Route::post('/update/{pid}', [App\Http\Controllers\propertiesController::class, 'update'])->name('update.property');
    });
    
    // Leases
    Route::prefix('leases')->group(function () {
        Route::get('/', [App\Http\Controllers\leasesController::class, 'index'])->name('leases');
        Route::get('/create', [App\Http\Controllers\leasesController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\leasesController::class, 'store'])->name('create.lease');
        Route::get('/delete/{pid}', [App\Http\Controllers\leasesController::class, 'destroy']);
        Route::get('/edit/{pid}', [App\Http\Controllers\leasesController::class, 'edit'])->name('Edit Lease');
        Route::post('/update/{pid}', [App\Http\Controllers\leasesController::class, 'update'])->name('update.lease');
    });

    // Employess
    Route::prefix('employees')->group(function () {
        Route::get('/', [App\Http\Controllers\employeesController::class, 'index'])->name('employees');
        Route::get('/create', [App\Http\Controllers\employeesController::class, 'create'])->name('Create Employee');
        Route::post('/store', [App\Http\Controllers\employeesController::class, 'store'])->name('create.employee');
        Route::get('/delete/{pid}', [App\Http\Controllers\employeesController::class, 'destroy']);
        Route::get('/edit/{pid}', [App\Http\Controllers\employeesController::class, 'edit']);
        Route::post('/update/{pid}', [App\Http\Controllers\employeesController::class, 'update'])->name('update.employee');
    });

    // Email
    Route::prefix('emails')->group(function () {
        Route::get('/compose', [emailsController::class, 'compose'])->name('compose');
        Route::get('/inbox', [emailsController::class, 'inbox'])->name('inbox');
        Route::get('/send-mail', [emailsController::class, 'sendMail']);
    });
 
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');