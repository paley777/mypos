<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokBarangController;

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
Route::get('/', [LandingController::class, 'index']);
Route::post('/', [LandingController::class, 'authenticate']);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::post('/logout', [DashboardController::class, 'logout'])->middleware('auth');
Route::resource('/dashboard/regis-barang', BarangController::class)->middleware('auth');
Route::resource('/dashboard/regis-supplier', SupplierController::class)->middleware('auth');
Route::resource('/dashboard/stok-barang', StokBarangController::class)->middleware('auth');
Route::resource('/dashboard/barang-masuk', BarangMasukController::class)->middleware('auth');
