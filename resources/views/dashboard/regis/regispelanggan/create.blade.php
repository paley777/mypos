@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Registrasi Pelanggan</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div><!--//row-->
                <div class="app-card app-card-notification shadow-sm mb-4">
                    <div class="app-card-header px-4 py-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <div class="app-icon-holder">
                                    <i class="bi bi-receipt" style="font-size: 1.5rem;"></i>
                                </div><!--//app-icon-holder-->
                            </div><!--//col-->
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <div class="notification-type mb-2"><span class="badge bg-primary">Olah Data</span></div>
                                <h4 class="notification-title mb-1">Formulir Pelanggan Baru</h4>
                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Create</li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">System</li>
                                </ul>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <form class="row g-3 px-4 py-2" method="post" action="/dashboard/regis-pelanggan">
                            @csrf
                            <!-- Nama Pelanggan -->
                            <div class="col-md-6">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" id="nama_pelanggan" class="form-control" name="nama"
                                        placeholder="Isi Nama Pelanggan" required>
                                </div>
                            </div>
                            <!-- No. Telp -->
                            <div class="col-md-6">
                                <label for="no_telp" class="form-label">No. Telp<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                    <input type="tel" id="no_telp" class="form-control" name="no_tlp"
                                        placeholder="Isi Nomor Telepon" required>
                                </div>
                            </div>
                            <!-- Alamat -->
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <input type of="text" id="alamat" class="form-control" name="alamat"
                                    placeholder="Isi Alamat" required>
                            </div>
                            <div class="col-12">
                                <small>(Kolom bertanda <span class="text-danger">*</span> wajib diisi).</small>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 py-3 fw-bold text-white" type="submit">
                                    <i class="bi bi-send me-2"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   
@endsection
