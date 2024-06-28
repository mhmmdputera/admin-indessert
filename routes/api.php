<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

/**
 * Route API Auth
 */
Route::post('/login', [AuthController::class, 'login'])->name('api.customer.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.customer.register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', [AuthController::class, 'getUser'])->name('api.customer.user');
    Route::put('/user/update', [AuthController::class, 'updateProfile'])->name('api.customer.updateUser');
    Route::post('/user/remove', [AuthController::class, 'deleteUser'])->name('api.customer.delete');

    /**
    * Router Order
    */
    Route::get('/order', [OrderController::class, 'index'])->name('api.order.index');
    Route::get('/order/{snap_token?}', [OrderController::class, 'show'])->name('api.order.show');
    Route::put('/order/{id}/confirm', [OrderController::class, 'confirmOrderReceived'])->name('api.order.confirm');
    Route::put('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('api.order.updateStatus');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('api.order.checkout');
    Route::put('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('api.order.cancel');
    Route::get('/order/{snap_token?}/pdf', [OrderController::class, 'exportPdf'])->name('api.order.pdf');
    

    /**
     * Route API Cart
     */
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('customer.cart.store');
    Route::get('/cart/total', [CartController::class, 'getCartTotal'])->name('customer.cart.total');
    Route::get('/cart/totalWeight', [CartController::class, 'getCartTotalWeight'])->name('customer.cart.getCartTotalWeight');
    Route::get('/cart/quantity', [CartController::class, 'getCartQuantity'])->name('customer.cart.getCartQuantity');
    Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('customer.cart.remove');
    Route::post('/cart/removeAll', [CartController::class, 'removeAllCart'])->name('customer.cart.removeAll');

    /**
     * Route Checkout
     */
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    
});

/**
 * Route API Category
 */
Route::get('/categories', [CategoryController::class, 'index'])->name('customer.category.index');
Route::get('/category/{slug?}', [CategoryController::class, 'show'])->name('customer.category.show');
Route::get('/categoryHeader', [CategoryController::class, 'categoryHeader'])->name('customer.category.categoryHeader');

/**
 * Route API Product
 */
Route::get('/products', [ProductController::class, 'index'])->name('customer.product.index');
Route::get('/product/{slug?}', [ProductController::class, 'show'])->name('customer.product.show');

/**
 * Route API Kabupaten
 */
Route::get('/kabupatens', [KabupatenController::class, 'index'])->name('customer.kabupaten.index');
Route::get('/kabupaten/{id?}', [KabupatenController::class, 'show'])->name('customer.kabupaten.show');
Route::get('/kabupatenHeader', [KabupatenController::class, 'kabupatenHeader'])->name('customer.kabupaten.kabupatenHeader');
Route::get('/kabupatens/{id}/kecamatans', [KecamatanController::class, 'getKecamatansByKabupatenId'])->name('customer.kabupaten.getKecamatansByKabupatenId');


/**
 * Route API Kecamatan
 */
Route::get('/kecamatans', [KecamatanController::class, 'index'])->name('customer.kecamatan.index');
Route::get('/kecamatan/{id?}', [KecamatanController::class, 'show'])->name('customer.kecamatan.show');

/**
 * Route notifikasi handler
 */
Route::post('/notificationHandler', [CheckoutController::class, 'notificationHandler'])->name('notificationHanlder');

/**
 * Route API Slider
 */
Route::get('/sliders', [SliderController::class, 'index'])->name('customer.slider.index');