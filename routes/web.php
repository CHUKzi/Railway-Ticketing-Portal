<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\TicketBookingController;
use App\Http\Controllers\TicketsFaresController;
use App\Http\Controllers\TrainsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return redirect('/login');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

//Routes
Route::middleware('auth')->group(function () {
    //Stations
    Route::prefix('/train-stations')->group(function () {
        Route::get('/', [StationsController::class, 'index'])->name('stations.index');
        Route::get('/create', [StationsController::class, 'create'])->name('stations.create');
        Route::get('/view/{id}', [StationsController::class, 'view'])->name('stations.view');
        Route::post('/store', [StationsController::class, 'store'])->name('stations.store');
        Route::get('/edit/{id}', [StationsController::class, 'edit'])->name('stations.edit');
        Route::put('/update/{id}', [StationsController::class, 'update'])->name('stations.update');
        Route::delete('/destroy/{id}', [StationsController::class, 'destroy'])->name('stations.destroy');
        //Ticket Checkers
        Route::get('/{id}/create-checker', [StationsController::class, 'checker_create'])->name('stations.checker.create');
        Route::post('/store-checker', [StationsController::class, 'checker_store'])->name('stations.checker.store');
        Route::get('{station_id}/history-checker/{id}', [StationsController::class, 'checker_history'])->name('stations.checker.history');
        Route::delete('delete_checker/{id}', [StationsController::class, 'delete_checker'])->name('stations.checker.delete');
    });

    //Trains
    Route::prefix('/trains')->group(function () {
        Route::get('/', [TrainsController::class, 'index'])->name('trains.index');
        Route::get('/create', [TrainsController::class, 'create'])->name('trains.create');
        Route::post('/store', [TrainsController::class, 'store'])->name('trains.store');
        Route::get('/edit/{id}', [TrainsController::class, 'edit'])->name('trains.edit');
        Route::put('/update/{id}', [TrainsController::class, 'update'])->name('trains.update');
        Route::delete('/destroy/{id}', [TrainsController::class, 'destroy'])->name('trains.destroy');
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/view/{id}', [UsersController::class, 'view'])->name('users.view');
        Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/payments', [UsersController::class, 'payments'])->name('users.index.payments');
    });

    //Packages
    Route::prefix('/packages')->group(function () {
        Route::get('/', [PackagesController::class, 'index'])->name('packages.index');
        Route::get('/create', [PackagesController::class, 'create'])->name('packages.create');
        Route::post('/store', [PackagesController::class, 'store'])->name('packages.store');
        Route::get('/edit/{id}', [PackagesController::class, 'edit'])->name('packages.edit');
        Route::put('/update/{id}', [PackagesController::class, 'update'])->name('packages.update');
        Route::delete('/destroy/{id}', [PackagesController::class, 'destroy'])->name('packages.destroy');
    });

    //Staff
    Route::prefix('/staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/store', [StaffController::class, 'store'])->name('staff.store');
        Route::delete('/destroy/{id}', [StaffController::class, 'destroy'])->name('user.destroy');
    });

    //Profile
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/password/update', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    });

    //Tickets Fares
    Route::prefix('/tickets-fares')->group(function () {
        Route::get('/', [TicketsFaresController::class, 'index'])->name('tickets.fares.index');
        Route::get('/create', [TicketsFaresController::class, 'create'])->name('tickets.fares.create');
        Route::post('/store', [TicketsFaresController::class, 'store'])->name('tickets.fares.store');
        Route::delete('/destroy/{id}', [TicketsFaresController::class, 'destroy'])->name('tickets.fares.destroy');
    });

    //Tickets Bookings
    Route::prefix('/ticket-bookings')->group(function () {
        Route::get('/', [TicketBookingController::class, 'index'])->name('tickets.bookings.index');
    });

    //CMS
    Route::prefix('/cms')->group(function () {
        Route::get('/terms-policies', [CmsController::class, 'termsAndPolicies'])->name('terms.policies');
        Route::post('/terms-policies/update', [CmsController::class, 'updateTermsAndPolicies'])->name('terms.policies.update');
    });
});

require __DIR__ . '/auth.php';
