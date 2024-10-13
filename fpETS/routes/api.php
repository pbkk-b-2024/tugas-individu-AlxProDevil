<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthAPIController;
use App\Http\Controllers\Api\OrderAPIController;
use App\Http\Controllers\Api\SupplierAPIController;
use App\Http\Controllers\Api\ProductAPIController;
use App\Http\Controllers\Api\PaymentAPIController;
use App\Http\Controllers\Api\CategoryAPIController;
use App\Http\Controllers\Api\ReviewAPIController;
use App\Http\Controllers\Api\ShipmentAPIController;

Route::post('/register', [AuthAPIController::class, 'register']);

Route::apiResource('/categories', CategoryAPIController::class);

Route::apiResource('/products', ProductAPIController::class);

Route::apiResource('/orders', OrderAPIController::class);

Route::apiResource('/payments', PaymentAPIController::class);

Route::apiResource('/shipments', ShipmentAPIController::class);

Route::apiResource('/suppliers', SupplierAPIController::class);

Route::apiResource('/reviews', ReviewAPIController::class);