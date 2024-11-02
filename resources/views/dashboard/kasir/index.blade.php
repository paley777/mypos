@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Kasir</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="row">
                            <div class="col-sm-12 col-lg-8">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-header px-4 py-3">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12  col-lg-auto text-center text-lg-start">
                                                <div class="app-icon-holder">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                        class="bi bi-receipt" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                        <path fill-rule="evenodd"
                                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </div><!--//app-icon-holder-->
                                            </div><!--//col-->
                                            <div class="col-12 col-lg-6 text-center text-lg-start">
                                                <div class="notification-type mb-2"><span
                                                        class="badge bg-primary">Transaksi</span></div>
                                                <h4 class="notification-title mb-1">Keranjang</h4>
                                                <ul class="notification-meta list-inline mb-0">
                                                    <li class="list-inline-item">Create</li>
                                                    <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item">System</li>
                                                </ul>
                                            </div><!--//col-->
                                            <div class="d-flex ms-auto col-12 col-lg-auto justify-content-center">
                                                <button class="btn app-btn-primary" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">
                                                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M13 3C13 2.44772 12.5523 2 12 2C11.4477 2 11 2.44772 11 3V11H3C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11V21C11 21.5523 11.4477 22 12 22C12.5523 22 13 21.5523 13 21V13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H13V3Z"
                                                                fill="#ffffff"></path>
                                                        </g>
                                                    </svg>
                                                    Tambah Pesanan
                                                </button>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                    </div><!--//app-card-header-->
                                    <div class="app-card-body">
                                        <form class="row g-2" method="post" action="/dashboard/cashier">
                                            @csrf
                                            <div class="table-responsive p-4"
                                                style="overflow-x: auto; white-space: nowrap;">
                                                <table id="example1" class="table app-table-hover mb-0 text-left"
                                                    style="table-layout: fixed;">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell" style="width: 150px;">Nama Barang</th>
                                                            <th class="cell" style="width: 50px;">Satuan</th>
                                                            <th class="cell" style="width: 30px;">Stok</th>
                                                            <th class="cell" style="width: 70px;">Harga</th>
                                                            <th class="cell" style="width: 70px;">Qty</th>
                                                            <th class="cell" style="width: 40px;">Disc (%)</th>
                                                            <th class="cell" style="width: 70px;">Disc (Rp.)</th>
                                                            <th class="cell" style="width: 70px;">Subtotal</th>
                                                            <th class="cell" style="width: 30px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data rows will be inserted here dynamically -->
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div><!--//app-card-body-->
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-header px-4 py-3">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                                <div class="app-icon-holder">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                        class="bi bi-receipt" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                        <path fill-rule="evenodd"
                                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </div><!--//app-icon-holder-->
                                            </div><!--//col-->
                                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                                <div class="notification-type mb-2"><span
                                                        class="badge bg-primary">Transaksi</span></div>
                                                <h4 class="notification-title mb-1">Formulir Transaksi Baru</h4>
                                                <ul class="notification-meta list-inline mb-0">
                                                    <li class="list-inline-item">Create</li>
                                                    <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item">System</li>
                                                </ul>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                    </div><!--//app-card-header-->
                                    <div class="app-card-body p-4">
                                        <div class="row g-1">
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Kasir<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama_petugas"
                                                    value="{{ Auth::user()->nama }}" readonly required>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Kode Invoice<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="kode_inv"
                                                    value="{{ $kode_inv }}" readonly required>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Nama Pelanggan<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="nama_pelanggan" required>
                                                    <option value="">Pilih Pelanggan</option>
                                                    @foreach ($pelanggans as $pelanggan)
                                                        <option value="{{ $pelanggan->nama }}">{{ $pelanggan->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Status<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="LUNAS">LUNAS</option>
                                                    <option value="HUTANG">HUTANG</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Jatuh Tempo (Jika
                                                    status
                                                    HUTANG)</label>
                                                <input type="date" class="form-control" name="jatuh_tempo">
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Keterangan<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="keterangan"
                                                    placeholder="Isi Keterangan" value="-">
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Total<span
                                                        class="text-danger">*</span></label>
                                                <input data-type='currency' type="text" id="total" value="0"
                                                    class="form-control form-control-lg total" name="total" required
                                                    readonly>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Bayar<span
                                                        class="text-danger">*</span></label>
                                                <input data-type='currency' type="text" id="bayar" value="0"
                                                    class="form-control form-control-lg" name="bayar" required>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Kembalian/Sisa Bayar
                                                    (Jika Minus)<span class="text-danger">*</span></label>
                                                <input data-type='currency' type="text" id="kembalian"
                                                    class="form-control form-control-lg" name="kembalian" value="0"
                                                    required readonly>
                                            </div>
                                        </div>
                                        <p>
                                            (Wajib terisi untuk kolom dengan tanda "<span class="text-danger">*</span>").
                                        </p>
                                    </div><!--//app-card-body-->
                                    <div class="app-card-footer px-4 py-3">
                                        <button class="btn app-btn-primary" type="submit">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </svg> Simpan Transaksi
                                        </button>
                                        </form>
                                    </div><!--//app-card-footer-->
                                </div>
                            </div>
                        </div>
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
    <div class="modal fade" id="modalSukses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi Sukses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-4">
                        <table id="example" class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">No.</th>
                                    <th class="cell">Nama Barang</th>
                                    <th class="cell">Satuan</th>
                                    <th class="cell">Stok</th>
                                    <th class="cell">Harga</th>
                                    <th class="cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stokbarangs as $key => $stokbarang)
                                    @if ($stokbarang->stok != 0)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stokbarang->nama_barang }}</td>
                                            <td>{{ $stokbarang->satuan }}</td>
                                            <td>{{ $stokbarang->stok }}</td>
                                            <td>@currency($stokbarang->harga_jual)</td>
                                            <td><button class="btn app-btn-primary tambah-ke-keranjang" type="button"
                                                    data-nama_barang="{{ $stokbarang->nama_barang }}"
                                                    data-satuan="{{ $stokbarang->satuan }}"
                                                    data-stok="{{ $stokbarang->stok }}"
                                                    data-harga_jual="{{ $stokbarang->harga_jual }}">Tambah
                                                    Pesanan
                                                </button></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                </div>
            </div>
        </div>
    </div>
    <script>
        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
        $(document).ready(function() {
            var table = $('#example1').DataTable();
            table.page.len(100).draw();
            $(document).on('click', '.tambah-ke-keranjang', function() {
                // Mengambil data
                function formatNumberWithCommas(number) {
                    return number.toLocaleString('en-US');
                }

                function removeCommas(str) {
                    return str.replace(/,/g, '');
                }

                var nama_barang = $(this).data("nama_barang");
                var satuan = $(this).data("satuan");
                var stok = $(this).data("stok");
                var harga_jual = $(this).data("harga_jual");
                var qty = 0; // Default qty
                var discountPercent = 0; // Default diskon dalam persentase
                var discountRp = 0; // Default diskon dalam rupiah

                // Gunakan escapeHtml untuk mengamankan karakter spesial
                var escapedNamaBarang = escapeHtml(nama_barang);

                var data = [
                    ['<input type="text" class="form-control" name="nama_barang[]" value="' +
                        escapedNamaBarang + '" readonly>', satuan, stok,
                        '<input  type="text" class="form-control" name="harga_jual[]" value="' +
                        formatNumberWithCommas(harga_jual) + '" readonly>',
                        '<input type="number" class="form-control qty" onkeypress="return event.charCode >= 48" id="inp1" name="qty[]" min="1" value="' +
                        qty + '">',
                        '<input type="number" class="form-control discount-percent" name="disc_perc[]" value="' +
                        discountPercent + '"  min="0" max="100">',
                        '<input type="number" class="form-control discount-rp" name="disc_rp[]" value="' +
                        discountRp + '" min="0">',
                        '<input type="text" class="form-control subtotal" name="subtotal[]" value="0" readonly>',
                        '<button class="btn btn-sm btn-danger text-white hapus-baris"><svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>'
                    ]
                ];

                var tableRow = table.rows.add(data).draw().node();
                $('.subtotal')
            });
            $(document).on('click', '.hapus-baris', function() {

                var table = $('#example1').DataTable();
                var row = $(this).closest('tr');
                table.row(row).remove().draw();
                hitungTotal();
                // Fungsi untuk menghitung total
                function hitungTotal() {
                    var total = 0;
                    table.rows().every(function() {
                        var data = this.data();
                        var subtotal = parseInt(row.find('td:eq(7) input').val().replace(/,/g, ''));
                        total += subtotal;
                    });
                    $('.total').val(total);
                }
            });

            $(document).on('input', '.qty, .discount-percent, .discount-rp', function() {
                function formatNumberWithCommas(number) {
                    return number.toLocaleString('en-US');
                }
                var row = $(this).closest('tr');
                var qty = parseInt(row.find('td:eq(4) input').val());
                var harga_jual = row.find('td:eq(3) input').val().replace(/,/g, '');
                var discountPercent = parseInt(row.find('td:eq(5) input').val());
                var discountRp = parseFloat(row.find('td:eq(6) input').val());
                var stok = row.find('td:eq(2)').text().replace(/[^0-9.]/g, '');
                var subtotal = qty * harga_jual;
                // Batasi qty hingga maksimum stok yang tersedia
                if (qty > stok) {
                    qty = stok;
                    $(this).val(qty);
                }
                // Hitung subtotal berdasarkan perubahan qty
                row.find('td:eq(4) input').val(qty);
                subtotal = qty * harga_jual;

                // Hitung diskon dalam rupiah
                var diskonRpAmount = discountRp;
                row.find('td:eq(6) input').val(discountRp);
                row.find(
                    'td:eq(5) input').val(0); // Nolkan diskon dalam persentase
                subtotal -= diskonRpAmount;

                // Hitung diskon dalam persentase
                var diskonPercentAmount = subtotal * discountPercent / 100;
                row.find('td:eq(5) input').val(
                    discountPercent);
                subtotal -= diskonPercentAmount;
                row.find('td:eq(7) input').val(formatNumberWithCommas(subtotal));

                // Update the data in the DataTable
                var rowData = table.row(row).data();
                rowData[7] =
                    '<input type="text" class="form-control" name="subtotal[]" value="' +
                    formatNumberWithCommas(subtotal) +
                    '" readonly>';
                table.row(row).data(rowData).draw();
                row.find('.qty').val(qty);
                row.find(
                    '.discount-percent').val(discountPercent);
                row.find('.discount-rp').val(discountRp);
                // Hitung total
                hitungTotal();
                // Fungsi untuk menghitung total
                function hitungTotal() {
                    var total = 0;
                    table.rows().every(function() {
                        var data = this.data();
                        var subtotal = parseInt(this.data()[7].replace(/[^0-9.]/g, ''));
                        total += subtotal;
                    });
                    $('.total').val(total);
                    formatCurrency($('.total'));
                }
            });
        });
    </script>
    <script>
        document.getElementById("inp1").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
        });
        $("#inp1").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "1")
            }
        })
    </script>

    <!-- Script JavaScript untuk menampilkan modal -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $('#modalSukses').modal('show');
                $('#successMessage').text("{{ session('success') }}");
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Event listener for the 'bayar' input field
            $('#bayar').on('input', function() {
                // Get the values of 'bayar' and 'total' inputs
                const bayar = parseFloat($(this).val().replace(/,/g, '')) || 0;
                const total = parseFloat($('#total').val().replace(/,/g, '')) || 0;

                // Calculate the 'kembalian'
                const kembalian = bayar - total;

                // Update the 'kembalian' input field
                $('#kembalian').val(formatNumber(kembalian.toString()));
                if (bayar < total) {
                    const kembalians = "-" + $('#kembalian').val();

                    $('#kembalian').val(kembalians);
                }


            });


        });

        // Function to format numbers with commas
        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Function to format currency
        function formatCurrency(input, blur) {
            var input_val = input.val();

            if (input_val === "") {
                return;
            }

            var original_len = input_val.length;
            var caret_pos = input.prop("selectionStart");

            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                left_side = formatNumber(left_side);
                right_side = formatNumber(right_side);

                if (blur === "blur") {
                    right_side += "";
                }

                right_side = right_side.substring(0, 2);
                input_val = left_side + "." + right_side;
            } else {
                input_val = formatNumber(input_val);
                if (blur === "blur") {
                    input_val += "";
                }
            }

            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });
    </script>
@endsection
