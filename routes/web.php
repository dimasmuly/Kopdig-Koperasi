<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RedirectIfAuthenticated;
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


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('block_user');
Route::post('login', [AuthController::class, 'login'])->name('login.action')->middleware('block_user');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/administrator', [AdminController::class, 'administrator'])->name('admin.administrator');
        Route::get('/admin/market', [AdminController::class, 'market'])->name('admin.market');
        Route::get('/admin/stash', [AdminController::class, 'stash'])->name('admin.stash');
        Route::get('/admin/loan', [AdminController::class, 'loan'])->name('admin.loan');
    });
});
