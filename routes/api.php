<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Routes (without Authentication)
Route::post('/register', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotEmail']);
Route::post('/verify/otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset/password', [AuthController::class, 'resetPassword']);

// Auth Routes (with Authentication)
Route::middleware('auth:api')->group(function () {
    Route::post('/update/to-vendor', [AuthController::class, 'updateToVendorProfile']);
});

// Category Routes (with Authentication)
Route::group(
    ['prefix' => 'category', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/add-category', [CategoryController::class, 'addCategory']);
        Route::post('/list', [CategoryController::class, 'categoryList']);
    }
);
