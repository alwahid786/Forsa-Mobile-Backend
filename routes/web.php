<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/login', function () {
    return view('pages.admin.auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard.dashboard');
});

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
