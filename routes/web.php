<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

// Route yangh bisa diakses ketika belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Route yang bisa diakses ketika sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role::admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update'); 
        Route::delete('/users/destory/{user}', [UserController::class, 'destory'])->name('user.destory');
        });

        Route::middleware('role:admin,kasir')->group(function () {
         Route::resource('/produk', ProdukController::class);
         Route::resource('/penjualan', PenjualanController::class);
         Route::resource('/itempenjualan', itemPenjualanController::class);
            return view('penjualan.index');
         });
    });