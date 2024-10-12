<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthAPIController;
use App\Http\Controllers\Api\OrderAPIController;
use App\Http\Controllers\Api\SupplierAPIController;
use App\Http\Controllers\Api\ProductAPIController;
use App\Http\Controllers\Api\PaymentAPIController;

Route::post('register', [AuthAPIController::class, 'register']);
Route::post('login', [AuthAPIController::class, 'login']);

Route::apiResource('/products', ProductAPIController::class);

Route::apiResource('/orders', OrderAPIController::class);

Route::apiResource('/payments', PaymentAPIController::class);

Route::apiResource('/suppliers', SupplierAPIController::class);