<?php

namespace App\Http\Controllers\Admin;

use App\Models\Telegram;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {
        
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //route category
        Route::resource('/category', CategoryController::class, ['as' => 'admin']);

        //route product
        Route::resource('/product', ProductController::class, ['as' => 'admin']);

        //route order
        Route::resource('/order', OrderController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        //route customer
        Route::resource('/customer', CustomerController::class, ['except' => ['edit'], 'as' => 'admin']);
        // Route::get('customer/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');
        // Route::delete('customer/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');

        //route slider
        Route::resource('/slider', SliderController::class, ['except' => ['show', 'create', 'edit', 'update'], 'as' => 'admin']);

        //profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');

        //route user
        Route::resource('/user', UserController::class, ['except' => ['show'], 'as' => 'admin']);

        //route kabupaten
        Route::resource('/kabupaten', KabupatenController::class, ['except' => ['show'], 'as' => 'admin']);

        //route kecamatan
        Route::resource('/kecamatan', KecamatanController::class, ['except' => ['show'], 'as' => 'admin']);

        //route laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.laporan.cetak');

        //route riwayat pesanan
        Route::resource('/riwayat', RiwayatController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        //route telegram
        Route::resource('/telegram', TelegramController::class, ['except' => ['show', 'create'], 'as' => 'admin']);
    });
});