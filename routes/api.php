<?php

use App\Http\Controllers\Api\PackagesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//API Integrations
Route::middleware('api')->prefix('/v1')->group(function () {
    // User Authentication
    Route::prefix('/user')->group(function () {
        Route::post('/store', [UsersController::class, 'store'])->name('user.store');
        Route::post('/auth', [UsersController::class, 'auth'])->name('user.auth');
    });

    // Packages
    Route::prefix('/packages')->middleware('auth:api')->group(function () {
        Route::get('/', [PackagesController::class, 'index'])->name('api.packages.index');
        Route::get('/{id}', [PackagesController::class, 'indexSingle'])->name('api.packages.index.single');
    });
});
