<?php

/**
 * Web Routes
 * 
 * This file defines all web routes for the application. Routes are grouped based on their 
 * functionalities such as authentication, dashboard navigation, resource management, and reporting.
 * Middleware is applied to routes to ensure authentication where necessary.
 */

// Importing necessary controllers
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PiutangController;

/*
|--------------------------------------------------------------------------
| Landing/Login Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('login'); // Landing page
Route::post('/', [LandingController::class, 'authenticate']);       // Login authentication

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth'); // Dashboard home
Route::post('/logout', [DashboardController::class, 'logout'])->middleware('auth');  // Logout functionality

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
*/
// Barang (Products)
Route::resource('/dashboard/regis-barang', BarangController::class)->middleware('auth');

// Supplier
Route::resource('/dashboard/regis-supplier', SupplierController::class)->middleware('auth');

// Stock Management
Route::resource('/dashboard/stok-barang', StokBarangController::class)->middleware('auth');

// Barang Masuk (Incoming Goods)
Route::resource('/dashboard/barang-masuk', BarangMasukController::class)->middleware('auth');
Route::get('/dashboard/barang-masuk/{BarangMasuk}/lunas', [BarangMasukController::class, 'lunas'])->middleware('auth');

// Barang Keluar (Outgoing Goods)
Route::resource('/dashboard/barang-keluar', BarangKeluarController::class)->middleware('auth');

// Pelanggan (Customers)
Route::resource('/dashboard/regis-pelanggan', PelangganController::class)->middleware('auth');

// Piutang (Debts)
Route::resource('/dashboard/piutang', PiutangController::class)->middleware('auth');
Route::post('/dashboard/piutang/bayar', [PiutangController::class, 'bayar'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Cashier and Transactions
|--------------------------------------------------------------------------
*/
Route::get('/dashboard/cashier', [TransactionController::class, 'index'])->middleware('auth'); // Cashier interface
Route::post('/dashboard/cashier', [TransactionController::class, 'store'])->middleware('auth'); // Store new transaction

/*
|--------------------------------------------------------------------------
| Invoice Management
|--------------------------------------------------------------------------
*/
Route::get('/dashboard/invoice', [InvoiceController::class, 'index'])->middleware('auth'); // List invoices
Route::get('/dashboard/invoice/{transaction}/rombak', [TransactionController::class, 'rombak_view'])->middleware('auth'); // Modify invoice view
Route::post('/dashboard/invoice/{transaction}/rombak', [TransactionController::class, 'rombak'])->middleware('auth');     // Update invoice
Route::post('/dashboard/invoice/{transaction}/update', [InvoiceController::class, 'update'])->name("invoice.update")->middleware('auth'); // Update invoice
Route::get('/dashboard/invoice/{transaction}/print', [InvoiceController::class, 'print'])->middleware('auth'); // Print invoice
Route::get('/dashboard/invoice/{transaction}/lunas', [InvoiceController::class, 'lunas'])->middleware('auth'); // Mark as paid
Route::delete('/dashboard/invoice/{transaction}', [InvoiceController::class, 'destroy'])->middleware('auth'); // Delete invoice

/*
|--------------------------------------------------------------------------
| Reporting Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard/report/barang-masuk', [ReportController::class, 'barang_masuk'])->middleware('auth'); // Incoming goods report
Route::get('/dashboard/report/barang-keluar', [ReportController::class, 'barang_keluar'])->middleware('auth'); // Outgoing goods report
Route::get('/dashboard/report/stok-barang', [ReportController::class, 'stok_barang'])->middleware('auth'); // Stock report
Route::get('/dashboard/report/invoice', [ReportController::class, 'invoice'])->middleware('auth'); // Invoice report
Route::get('/dashboard/report/order', [ReportController::class, 'order'])->middleware('auth'); // Order report
Route::get('/dashboard/report/penjualan', [ReportController::class, 'daily'])->middleware('auth'); // Daily sales report

/*
|--------------------------------------------------------------------------
| User Profile and About
|--------------------------------------------------------------------------
*/
Route::get('/dashboard/my-profile', [DashboardController::class, 'my_profile'])->middleware('auth'); // User profile
Route::get('/dashboard/my-profile/edit', [DashboardController::class, 'my_profile_edit'])->middleware('auth'); // Edit profile view
Route::post('/dashboard/my-profile/edit', [DashboardController::class, 'my_profile_store'])->middleware('auth'); // Update profile
Route::get('/dashboard/about', [DashboardController::class, 'about'])->middleware('auth'); // About page
