<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\DuesController;
use App\Http\Controllers\API\InstallmentController;
use App\Http\Controllers\API\LoanController;
use App\Http\Controllers\API\MailController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\StashController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/order/{id}', [OrderController::class, 'fetch'])->name('api.order.show');
Route::post('/order/update', [OrderController::class, 'update'])->name('api.order.update');
Route::get('/order/{id}/delete', [OrderController::class, 'delete'])->name('api.order.delete');

Route::get('/admin/{id}', [AdminController::class, 'fetch'])->name('api.admin.show', 'id');
Route::post('/admin/update', [AdminController::class, 'update'])->name('api.admin.update');
Route::post('/admin/store', [AdminController::class, 'store'])->name('api.admin.store');
Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('api.admin.delete');

Route::post('/product/store', [ProductController::class, 'store'])->name('api.product.store');
Route::get('/product/{id}', [ProductController::class, 'fetch'])->name('api.product.show');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('api.product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('api.product.delete');

Route::get('/stash/{id}', [StashController::class, 'fetch'])->name('api.stash.show');
Route::post('/stash/store', [StashController::class, 'store'])->name('api.stash.store');
Route::post('/stash/update/{id}', [StashController::class, 'update'])->name('api.stash.update');
Route::get('/stash/delete/{id}', [StashController::class, 'delete'])->name('api.stash.delete');

Route::post('/loan/store', [LoanController::class, 'store'])->name('api.loan.store');
Route::post('/loan/{id}/update', [LoanController::class, 'update'])->name('api.loan.update');
Route::post('/loan/{id}/delete', [LoanController::class, 'delete'])->name('api.loan.delete');
Route::get('/loan/loan_type/{id}', [LoanController::class, 'getLoanType'])->name('api.loan.loan_type');

Route::post('/installment/{id}/update', [InstallmentController::class, 'update'])->name('api.installment.update');
Route::post('/installment/{id}/delete', [InstallmentController::class, 'delete'])->name('api.installment.delete');

Route::post('/dues/store', [DuesController::class, 'store'])->name('api.dues.store');
Route::post('/dues/{id}/update', [DuesController::class, 'update'])->name('api.dues.update');
Route::get('/dues/{id}/delete', [DuesController::class, 'delete'])->name('api.dues.delete');
Route::get('/dues/type/{id}', [DuesController::class, 'getDuesType'])->name('api.dues.type');

Route::post('/mail/store', [MailController::class, 'store'])->name('api.mail.store');
Route::post('/mail/{id}/update', [MailController::class, 'update'])->name('api.mail.update');
Route::get('/mail/{id}/delete', [MailController::class, 'delete'])->name('api.mail.delete');
