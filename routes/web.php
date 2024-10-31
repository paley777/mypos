<?php

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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Landing Login
Route::get('/', [LandingController::class, 'index'])->name('login');
Route::post('/', [LandingController::class, 'authenticate']);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::post('/logout', [DashboardController::class, 'logout'])->middleware('auth');
Route::resource('/dashboard/regis-barang', BarangController::class)->middleware('auth');
Route::resource('/dashboard/regis-supplier', SupplierController::class)->middleware('auth');
Route::resource('/dashboard/stok-barang', StokBarangController::class)->middleware('auth');
Route::resource('/dashboard/barang-masuk', BarangMasukController::class)->middleware('auth');
Route::resource('/dashboard/piutang', PiutangController::class)->middleware('auth');
Route::post('/dashboard/piutang/bayar', [PiutangController::class, 'bayar'])->middleware('auth');
Route::resource('/dashboard/barang-keluar', BarangKeluarController::class)->middleware('auth');
Route::resource('/dashboard/regis-pelanggan', PelangganController::class)->middleware('auth');
Route::get('/dashboard/cashier', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/dashboard/invoice', [InvoiceController::class, 'index'])->middleware('auth');
Route::get('/dashboard/invoice/{transaction}/print', [InvoiceController::class, 'print'])->middleware('auth');
Route::get('/dashboard/invoice/{transaction}/lunas', [InvoiceController::class, 'lunas'])->middleware('auth');
Route::delete('/dashboard/invoice/{transaction}', [InvoiceController::class, 'destroy'])->middleware('auth');
Route::post('/dashboard/cashier', [TransactionController::class, 'store'])->middleware('auth');

Route::get('/dashboard/report/barang-masuk', [ReportController::class, 'barang_masuk'])->middleware('auth');
Route::get('/dashboard/report/barang-keluar', [ReportController::class, 'barang_keluar'])->middleware('auth');
Route::get('/dashboard/report/stok-barang', [ReportController::class, 'stok_barang'])->middleware('auth');
Route::get('/dashboard/report/invoice', [ReportController::class, 'invoice'])->middleware('auth');
Route::get('/dashboard/report/order', [ReportController::class, 'order'])->middleware('auth');
Route::get('/dashboard/report/penjualan', [ReportController::class, 'daily'])->middleware('auth');
Route::get('/dashboard/my-profile', [DashboardController::class, 'my_profile'])->middleware('auth');
Route::get('/dashboard/my-profile/edit', [DashboardController::class, 'my_profile_edit'])->middleware('auth');
Route::post('/dashboard/my-profile/edit', [DashboardController::class, 'my_profile_store'])->middleware('auth');
Route::get('/dashboard/about', [DashboardController::class, 'about'])->middleware('auth');
