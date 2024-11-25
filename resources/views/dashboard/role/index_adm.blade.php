@extends('templates.layouts.main1')

@section('container')
    <style>
        /* Gaya tombol */
        .btn-primary {
            color: white !important;
        }

        .btn-warning {
            color: black !important;
        }
    </style>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title mb-4">Beranda</h1>

                <!-- Welcome Card -->
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">Selamat Datang, {{ auth()->user()->nama }}!</h3>
                            <p>MyPOS adalah Sistem Manajemen Point of Sales yang memiliki beragam fitur yang memudahkan
                                manajemen stok, arus barang, kasir hingga pelaporan. Klik menu fitur di sidebar untuk
                                memulai!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><!--//app-card-body-->
                    </div><!--//inner-->
                </div><!--//app-card-->

                <!-- Stats Section -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Barang Masuk Hari Ini</h4>
                                <div class="stats-figure text-primary fw-bold">{{ $total_barangmasuk }}</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Stok</h4>
                                <div class="stats-figure text-warning fw-bold">{{ $total_stok }}</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Barang Keluar Hari Ini</h4>
                                <div class="stats-figure text-success fw-bold">{{ $total_barangkeluar }}</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

                <!-- Feature Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-box-arrow-in-down fs-3 text-primary"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Barang Masuk</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Mengelola arus barang yang masuk ke dalam manajemen stok barang.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/barang-masuk">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-box-arrow-up fs-3 text-success"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Barang Keluar</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Mengelola arus barang yang keluar dari manajemen stok barang.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/barang-keluar">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-box-seam fs-3 text-warning"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Stok Barang</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Mengelola stok barang yang ada di manajemen stok barang.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-warning text-black" href="/dashboard/stok-barang">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection
