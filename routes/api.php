<?php

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
    Route::prefix('/user')->group(function () {
        Route::post('/store', [UsersController::class, 'store'])->name('user.store');
        Route::post('/auth', [UsersController::class, 'auth'])->name('user.auth');
    });
});
