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
        Route::post('/store', [UsersController::class, 'store']);
        Route::post('/auth', [UsersController::class, 'auth']);
        Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth:api');
    });

    // Packages
    Route::prefix('/packages')->middleware('auth:api')->group(function () {
        Route::get('/', [PackagesController::class, 'index']);
        Route::get('/{id}', [PackagesController::class, 'indexSingle']);
        Route::post('/buy', [PackagesController::class, 'buyNow']);
    });

    // My Account
    Route::prefix('/my')->middleware('auth:api')->group(function () {
        Route::get('/payments', [UsersController::class, 'myPayments']);
        Route::get('/account', [UsersController::class, 'myAccount']);
        Route::get('/booking/history', [UsersController::class, 'bookingHistory']);
    });

    // Tickets
    Route::prefix('/tickets')->middleware('auth:api')->group(function () {
        Route::prefix('/book')->group(function () {
            Route::post('/qr-scan', [UsersController::class, 'qrScan']);
            Route::post('/pay', [UsersController::class, 'payNow']);
        });
    });

    // Cms
    Route::prefix('/cms')->group(function () {
        Route::get('/terms-policies', [UsersController::class, 'TermsAndPolicies']);
    });
});
