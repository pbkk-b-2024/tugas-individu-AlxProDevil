<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderAPIController;
use App\Http\Controllers\Api\SupplierAPIController;
use App\Http\Controllers\Api\ProductAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/products', ProductAPIController::class);

Route::apiResource('/orders', OrderAPIController::class);

Route::apiResource('/suppliers', SupplierAPIController::class);