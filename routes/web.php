<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

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

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::any('category', [CategoryController::class, 'category'])->name('category.post');
    Route::post('delete_category', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    Route::post('edit_category_view', [CategoryController::class, 'editCategoryData'])->name('edit.category.view');
    Route::post('edit_category', [CategoryController::class, 'editCategory'])->name('edit.category');

    Route::any('vendor_list', [UserController::class, 'listOfAllVendor']);
    Route::any('user_list', [UserController::class, 'listOfAllUsers']);

    Route::get('vendor_detail/{id}', [UserController::class, 'vendorDetail']);
    Route::get('user_detail/{id}', [UserController::class, 'userDetail']);


});
