<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TravelToursController;
use App\Http\Controllers\BookingController;

require __DIR__ . '/test.php';

Route::get('/', function () {
    return view('index');
});

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Customer Login Route
Route::get('/customer/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/customer/login', [AuthController::class, 'login'])->name('login');   
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Travel Agency Register
    Route::get('/travel_tours/register', [AuthController::class, 'showTravelAgencyRegister'])
        ->name('agency_register.form');
    Route::post('/travel_tours/register', [AuthController::class, 'registerTravelAgency'])
        ->name('agency_register');

    // Travel Agency Login
    Route::get('/travel_tours/login', [AuthController::class, 'showTravelAgencyLogin'])
        ->name('agency_login.form');
    Route::post('/travel_tours/login', [AuthController::class, 'loginTravelAgency'])
        ->name('agency_login');

    //Admin Register
    // Route::get('/admin/register', [AuthController::class, 'showAdminRegister'])
    //     ->name('admin_register.form');
    // Route::post('/admin/register', [AuthController::class, 'registerAdmin'])
    //     ->name('admin_register');

    //Admin Register
    Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])
        ->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])
        ->name('admin_register');

    //Admin Login
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->name('admin_login');

    //Admin Logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');

    
    // Admin routes
    Route::prefix('admin')->as('admin.')->middleware('role:admin')->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('/attractions', [\App\Http\Controllers\AdminAttractionController::class, 'index'])
            ->name('attractions.index');
        Route::get('/attractions/create', [\App\Http\Controllers\AdminAttractionController::class, 'create'])
            ->name('attractions.create');
        Route::post('/attractions', [\App\Http\Controllers\AdminAttractionController::class, 'store'])
            ->name('attractions.store');
        Route::get('/customers', [\App\Http\Controllers\AdminController::class, 'customers'])
            ->name('customers.index');
    });

// Travel & Tours routes
Route::prefix('travel_tours')->name('travel_tours.')->middleware('role:travel_agency')->group(function () {
    Route::get('/dashboard', [TravelToursController::class, 'dashboard'])->name('dashboard');
    Route::get('/agency-profile', [TravelToursController::class, 'agencyProfile'])->name('agency_prof.agency_profile');
    // tour packages
    Route::get('/tour_packages', [TravelToursController::class, 'index'])->name('tour_packages');
    Route::get('/tour_packages/create', [TravelToursController::class, 'create'])->name('tour_packages.create_packages');
    Route::post('/tour_packages/store', [TravelToursController::class, 'store'])->name('tour_packages.store');
    
    Route::get('/tour_packages/{package}', [TravelToursController::class, 'show'])->name('tour_packages.show');
    Route::get('/tour_packages/{package}/edit', [TravelToursController::class, 'edit'])->name('tour_packages.edit');
    Route::put('/tour_packages/{package}', [TravelToursController::class, 'update'])->name('tour_packages.update');
    Route::delete('/tour_packages/{package}', [TravelToursController::class, 'destroy'])->name('tour_packages.destroy');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.booking_request');
    Route::get('/customers', [TravelToursController::class, 'customers'])->name('customers');
    Route::get('/reports', [TravelToursController::class, 'reports'])->name('reports');
    Route::get('/drivers', [TravelToursController::class, 'drivers'])->name('driver_info.drivers');
});


// CUSTOMER ROUTES
Route::prefix('customer')->name('customer.')->middleware(['role:customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'customerDashboard'])->name('customer_dashboard');

    Route::get('/book_trip_package', [\App\Http\Controllers\CustomerController::class, 'customerPackages'])
        ->name('book_trip_package.trip_package');

    Route::get('/book_trip_package/{id}', [\App\Http\Controllers\CustomerController::class, 'storeBooking'])
        ->name('book_trip_package.show_trip');

    Route::post('/book-trip-package', [\App\Http\Controllers\BookingController::class, 'store'])
        ->name('book_trip_package.store');

    Route::get('/profile', [\App\Http\Controllers\CustomerController::class, 'showProfile'])
        ->name('customer_profile.profile');

    Route::post('/profile', [\App\Http\Controllers\CustomerController::class, 'updateProfile'])
        ->name('customer_profile.update');
});

