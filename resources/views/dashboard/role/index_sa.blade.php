@extends('templates.layouts.main')

@section('container')
    <style>
        /* Warna teks untuk tombol */
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
                            <p class="">MyPOS adalah Sistem Manajemen Point of Sales yang memiliki beragam fitur
                                untuk manajemen stok, arus barang, kasir hingga pelaporan. Klik menu fitur di sidebar untuk
                                memulai!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><!--//app-card-body-->
                    </div><!--//inner-->
                </div><!--//app-card-->
                <!-- Stats Section -->
                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Profit Hari Ini</h4>
                                <div class="stats-figure text-primary fw-bold">@currency($total_profit)</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Piutang</h4>
                                <div class="stats-figure text-danger fw-bold">@currency($total_piutang)</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Barang</h4>
                                <div class="stats-figure text-success fw-bold">{{ $total_barang }}</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4 text-center">
                                <h4 class="stats-type mb-1">Total Invoice Hari Ini</h4>
                                <div class="stats-figure text-warning fw-bold">{{ $total_inv }}</div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
                <!-- Table and Chart Section -->
                <div class="row g-4 mb-4">
                    <!-- Table -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>Profit Terakhir 7 Hari</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profits as $profit)
                                            <tr>
                                                <td>{{ $profit['date'] }}</td>
                                                <td>Rp. {{ $profit['total_profit'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>Grafik Profit</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="profitChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <i class="bi bi-cash-stack fs-3 text-success"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Kasir</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Buat transaksi baru bagi pelanggan, membuat invoice, dan mengelola histori
                                    arus barang keluar.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/cashier">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-receipt fs-3 text-warning"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Invoice</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Akses fitur invoice untuk transaksi pelanggan.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-warning text-white" href="/dashboard/invoice">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <!-- New Features -->
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-clipboard-data fs-3 text-info"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Piutang</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Kelola data piutang pelanggan dengan mudah.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/piutang">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-bar-chart-line fs-3 text-danger"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Laporan Penjualan</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Akses laporan penjualan untuk melihat kinerja penjualan.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/report/penjualan">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <i class="bi bi-box-seam fs-3 text-secondary"></i>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Stok Barang</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4">
                                <p class="intro">Kelola dan lihat informasi stok barang yang tersedia.</p>
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn btn-primary" href="/dashboard/stok-barang">Akses Fitur</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                </div><!--//row-->
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const profitData = @json($profits);
        const ctx = document.getElementById('profitChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: profitData.map(profit => profit.date),
                datasets: [{
                    label: 'Profit',
                    data: profitData.map(profit => parseInt(profit.total_profit.replace(/\./g, ''))),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp. ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
