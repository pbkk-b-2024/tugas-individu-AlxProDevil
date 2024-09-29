<?php
use App\Http\Controllers\Api\AuthAPIController;
use App\Http\Controllers\Api\SupplierAPIController;

route:apiResource('suppliers', SupplierAPIController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::put('profile', [AuthController::class, 'updateProfile']);
});

Route::controller(SupplierAPIController::class)->prefix('suppliers')->group(function () {
    Route::get('', 'index');              // GET /api/suppliers - List all suppliers
    Route::post('', 'store');             // POST /api/suppliers - Create a new supplier
    Route::get('{id}', 'show');           // GET /api/suppliers/{id} - Show a specific supplier
    Route::put('{id}', 'update');         // PUT /api/suppliers/{id} - Update a supplier
    Route::delete('{id}', 'destroy');     // DELETE /api/suppliers/{id} - Delete a supplier
});

Route::post('login', [AuthController::class, 'login']);