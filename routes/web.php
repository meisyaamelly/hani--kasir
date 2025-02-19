<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;


    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Halaman Admin Produk
        Route::get('/admin/produk', [ProdukController::class, 'index']);
        Route::get('/admin/produk/create', [ProdukController::class, 'create']);
        Route::post('/admin/produk/store', [ProdukController::class, 'store']);
        Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']);
        Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update']);
        Route::get('/admin/produk/delete/{id}', [ProdukController::class, 'delete']);

            // Halaman Admin Employee
        Route::get('/admin/employees', [EmployeeController::class, 'index']);
        Route::get('/admin/employees/create', [EmployeeController::class, 'create']);
        Route::post('/admin/employees/store', [EmployeeController::class, 'store']);
        Route::get('/admin/employees/edit/{id}', [EmployeeController::class, 'edit']);
        Route::post('/admin/employees/update/{id}', [EmployeeController::class, 'update']);
        Route::get('/admin/employees/delete/{id}', [EmployeeController::class, 'destroy']);
        Route::get('/admin/produk/search', [ProdukController::class, 'search']);


        // Penjualan
        Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'getDetail']);
        Route::delete('/penjualan/delete/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

        // Halaman Petugas Pelanggan
        Route::get('/petugas/pelanggan', [PelangganController::class, 'index']);
        Route::post('/petugas/pelanggan', [PelangganController::class, 'store']);
        Route::get('/petugas/pelanggan/edit/{id}', [PelangganController::class, 'edit']);
        Route::post('/petugas/pelanggan/update/{id}', [PelangganController::class, 'update']);
        Route::get('/petugas/pelanggan/delete/{id}', [PelangganController::class, 'delete']);
        Route::get('/petugas/order/{idPelanggan}', [OrderController::class, 'index']);
        Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
        Route::post('/transaksi/store', [TransaksiController::class, 'storeTransaction'])->name('transaksi.store');
        Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/struk/{id}', [StrukController::class, 'show'])->name('struk.show');