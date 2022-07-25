<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DuesController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StashController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', [AuthController::class, 'index'])->name('auth.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['middleware' => 'auth', 'check-role:2,3,5,6,7'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/market', [MarketController::class, 'index'])->name('dashboard.market');
    Route::get('/market/{id}/products', [MarketController::class, 'products'])->name('dashboard.market.products');
    Route::get('dashboard/order', [OrderController::class, 'index'])->name('dashboard.order');
    Route::get('dashboard/administrator', [AdministratorController::class, 'index'])->name('dashboard.administrator');
    Route::post('dashboard/administrator/search', [AdminController::class, 'search'])->name('dashboard.admin.search');
    Route::get('dashboard/stash', [StashController::class, 'index'])->name('dashboard.management.stash');
    Route::get('dashboard/loans', [LoanController::class, 'index'])->name('dashboard.management.loans');
    Route::get('dashboard/installment', [InstallmentController::class, 'index'])->name('dashboard.management.installment');
    Route::get('dashboard/dues', [DuesController::class, 'index'])->name('dashboard.management.dues');
    Route::get('dashboard/mails', [MailController::class, 'index'])->name('dashboard.mails');
});
