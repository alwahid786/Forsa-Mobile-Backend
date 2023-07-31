<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/stripe/connect-success', function () {
    return view('connect-success');
});


// auth routes

Route::any('login', [AuthController::class, 'login'])->name('login');

// Route::get('/login', function () {
//     return view('pages.admin.auth.login');
// });
Route::middleware(['auth'])->group(function () {
    
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/plot', function () {
    return view('pages.admin.plots.plot');
});

Route::get('/plot-detail', function () {
    return view('pages.admin.plots.plot-detail');
});

Route::get('/client', function () {
    return view('pages.admin.clients.client');
});

Route::get('/client-detail', function () {
    return view('pages.admin.clients.client-detail');
});

Route::get('/manager', function () {
    return view('pages.admin.managers.manager');
});

Route::get('/manager-detail', function () {
    return view('pages.admin.managers.manager-detail');
});
});
