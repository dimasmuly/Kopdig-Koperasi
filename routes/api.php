<?php

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
Route::post('/order/{id}', [OrderController::class, 'update'])->name('api.order.update', 'id');


