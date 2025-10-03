<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourPackageController;

Route::get('/', function () {
    return view('index');
});

//Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Customer Dashboard (public for now)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Admin routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/attractions', [\App\Http\Controllers\AdminAttractionController::class, 'index'])->name('attractions.index');
    Route::get('/attractions/create', [\App\Http\Controllers\AdminAttractionController::class, 'create'])->name('attractions.create');
    Route::post('/attractions', [\App\Http\Controllers\AdminAttractionController::class, 'store'])->name('attractions.store');
    Route::get('/customers', [\App\Http\Controllers\AdminController::class, 'customers'])->name('customers.index');
});

// Travel & Tours routes
Route::prefix('travel')->as('travel.')->group(function () {
    Route::get('/dashboard', [TravelToursController::class, 'dashboard'])->name('dashboard');
    Route::get('/agency-profile', [TravelToursController::class, 'agencyProfile'])->name('agency-profile');
    // Route::get('/tour_packages', [TravelToursController::class, 'tourPackages'])->name('tour_packages.index_packages');
    // Route::get('/tour_packages/create', [TravelToursController::class, 'create'])->name('tour_packages.create_packages');
    // Route::post('/tour_packages', [TravelToursController::class, 'store'])->name('tour_packages.store');
    // Route::get('/bookings', [\App\Http\Controllers\TravelToursController::class, 'bookings'])->name('bookings');
    // Route::get('/customers', [\App\Http\Controllers\TravelToursController::class, 'customers'])->name('customers');
    // Route::get('/reports', [\App\Http\Controllers\TravelToursController::class, 'reports'])->name('reports');
    // Route::get('/drivers-guides', [\App\Http\Controllers\TravelToursController::class, 'driversGuides'])->name('drivers-guides');
});

// Route::prefix('travel')->group(function () {
//     Route::get('/tour-packages', [TourPackageController::class, 'index'])->name('travel.tour-packages');
//     Route::post('/tour-packages', [TourPackageController::class, 'store'])->name('packages.store');
//     Route::get('/tour-packages/{package}/edit', [TourPackageController::class, 'edit'])->name('packages.edit');
//     Route::put('/tour-packages/{package}', [TourPackageController::class, 'update'])->name('packages.update');
//     Route::delete('/tour-packages/{package}', [TourPackageController::class, 'destroy'])->name('packages.destroy');
// });

