<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StationsController;
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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
    });

    //Staff
    Route::prefix('/staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
    });
});

require __DIR__ . '/auth.php';
