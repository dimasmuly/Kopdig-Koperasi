<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\OrderController;
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

