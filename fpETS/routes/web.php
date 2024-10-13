<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products.index'); // Updated name to 'products.index'
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    });    

    Route::resource('categories', CategoryController::class);

    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('cart', 'cart')->name('orders.cart');
        Route::post('add-to-cart', 'addToCart')->name('orders.addToCart');
        Route::delete('remove-from-cart/{id}', 'removeFromCart')->name('orders.removeFromCart');
        Route::post('checkout', 'checkout')->name('orders.checkout');
        Route::get('your-orders', 'userOrders')->name('orders.user');
        
        Route::middleware('can:view-orders')->group(function () {
            Route::get('all', 'allOrders')->name('orders.all');
        });
    });

    Route::controller(PaymentController::class)->prefix('payment')->group(function () {
        Route::get('/{order}', 'showPaymentPage')->name('payment.show');
        Route::post('/{order}/process', 'processPayment')->name('payment.process');
        Route::get('/{order}/upload-receipt', 'showUploadReceipt')->name('payment.uploadReceipt');
        Route::post('/{order}/upload-receipt', 'uploadReceipt')->name('payment.uploadReceipt.post');
        Route::post('/{order}/confirm', 'confirmPayment')->name('payment.confirm');
    });

    Route::controller(ShipmentController::class)->prefix('shipments')->group(function () {
        Route::get('', 'index')->name('shipments.index');
        Route::get('create/{order}', 'create')->name('shipments.create');
        Route::post('store/{order}', 'store')->name('shipments.store');
        Route::get('edit/{id}', 'edit')->name('shipments.edit');
        Route::put('update/{id}', 'update')->name('shipments.update');
        Route::get('show/{id}', 'show')->name('shipments.show');
    });  

    Route::controller(SupplierController::class)->prefix('suppliers')->group(function () {
        Route::get('', 'index')->name('suppliers');
        Route::get('create', 'create')->name('suppliers.create');
        Route::post('store', 'store')->name('suppliers.store');
        Route::get('show/{id}', 'show')->name('suppliers.show');
        Route::get('edit/{id}', 'edit')->name('suppliers.edit');
        Route::put('edit/{id}', 'update')->name('suppliers.update');
        Route::delete('destroy/{id}', 'destroy')->name('suppliers.destroy');
    });

    Route::controller(ReviewController::class)->prefix('reviews')->group(function () {
        Route::get('', 'index')->name('reviews.index');
        Route::get('create', 'create')->name('reviews.create');
        Route::post('store', 'store')->name('reviews.store');
        Route::get('edit/{id}', 'edit')->name('reviews.edit');
        Route::put('update/{id}', 'update')->name('reviews.update');
    });

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});