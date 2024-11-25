@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        /* Add spacing for search bar */
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 1rem;
        }
    </style>

    <div class="app-wrapper">
        <form class="row g-2" method="post" action="/dashboard/cashier">
            @csrf
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
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                            aria-labelledby="orders-all-tab">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                                        <div class="app-card-body p-4">
                                            <div class="row g-1">
                                                <div class="col-md-4 position-relative">
                                                    <label for="validationCustom01" class="form-label">Total<span
                                                            class="text-danger">*</span></label>
                                                    <input data-type='currency' type="text" id="total" value="0"
                                                        class="form-control form-control-lg total fw-bold text-primary fs-1"
                                                        name="total" required readonly>
                                                </div>
                                                <div class="col-md-4 position-relative">
                                                    <label for="validationCustom01" class="form-label">Bayar<span
                                                            class="text-danger">*</span></label>
                                                    <input data-type='currency' type="text" id="bayar" value="0"
                                                        class="form-control form-control-lg fw-bold fs-1" name="bayar"
                                                        required>
                                                </div>
                                                <div class="col-md-4 position-relative">
                                                    <label for="validationCustom01" class="form-label">Kembalian/Sisa Bayar
                                                        (Jika Minus)<span class="text-danger">*</span></label>
                                                    <input data-type='currency' type="text" id="kembalian"
                                                        class="form-control form-control-lg fw-bold text-danger fs-1"
                                                        name="kembalian" value="0" required readonly>
                                                </div>
                                            </div>
                                            <div class="app-card-footer px-4 py-3">
                                                <button class="btn app-btn-primary" type="submit" id="submitButton">
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
                                            </div><!--//app-card-footer-->
                                        </div><!--//app-card-body-->
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                                        <div class="app-card-header px-4 py-3">
                                            <div class="row g-3 align-items-center">
                                                <div class="col-12  col-lg-auto text-center text-lg-start">
                                                    <div class="app-icon-holder">
                                                        <i class="bi bi-receipt" style="font-size: 1.5rem;"></i>
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
                                                    <button class="btn app-btn-primary" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                                        <svg width="1em" height="1em" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                            <div class="table-responsive p-4"
                                                style="overflow-x: auto; white-space: nowrap;">
                                                <table id="example1"
                                                    class="table table-hover table-bordered mb-0 text-left"
                                                    style="table-layout: fixed;">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th class="cell" style="width: 150px;">Nama Barang</th>
                                                            <th class="cell" style="width: 50px;">Satuan</th>
                                                            <th class="cell" style="width: 30px;">Stok</th>
                                                            <th class="cell" style="width: 70px;">Harga</th>
                                                            <th class="cell" style="width: 70px;">Qty</th>
                                                            <th class="cell" style="width: 70px;">Disc (%)</th>
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
                                                        <i class="bi bi-receipt" style="font-size: 1.5rem;"></i>
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
                                                    <label for="validationCustom01" class="form-label ">Kode Invoice<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control fst-italic fw-bold"
                                                        name="kode_inv" value="{{ $kode_inv }}" readonly required>
                                                </div>
                                                <div class="col-md-12 position-relative">
                                                    <label for="validationCustom01" class="form-label ">Kasir<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control text-decoration-underline"
                                                        name="nama_petugas" value="{{ Auth::user()->nama }}" readonly
                                                        required>
                                                </div>
                                                <div class="col-md-12 position-relative">
                                                    <label for="validationCustom01" class="form-label ">Nama
                                                        Pelanggan<span class="text-danger">*</span></label>
                                                    <select name="nama_pelanggan" required>
                                                        <option value="" selected>Pilih Pelanggan</option>
                                                        @foreach ($pelanggans as $pelanggan)
                                                            <option value="{{ $pelanggan->nama }}">{{ $pelanggan->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 position-relative">
                                                    <label for="validationCustom01" class="form-label ">Status<span
                                                            class="text-danger">*</span></label>
                                                    <select name="status" required>
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
                                            </div>
                                            <p>
                                                (Wajib terisi untuk kolom dengan tanda "<span
                                                    class="text-danger">*</span>").
                                            </p>
                                        </div><!--//app-card-body-->
                                    </div>
                                </div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </form>
    </div><!--//app-content-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submitButton');

            submitButton.addEventListener('click', function() {
                // Ubah teks terlebih dahulu, lalu tunggu sebelum men-disable tombol
                submitButton.innerHTML = 'Memproses...'; // Ubah teks untuk memberi indikasi kepada pengguna

                // Set delay sebelum tombol di-disable
                setTimeout(() => {
                    submitButton.disabled = true; // Disable tombol setelah jeda 500ms
                }, 500); // 500ms delay sebelum tombol di-disable, bisa disesuaikan
            });
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function formatNumber(number) {
            return number.toLocaleString('en-US');
        }

        function removeCommas(str) {
            return str.replace(/,/g, '');
        }

        function formatCurrency(input, blur = false) {
            let inputVal = input.val();
            if (!inputVal) return;

            // Remove non-numeric characters except for the decimal point
            inputVal = inputVal.replace(/[^0-9.]/g, '');

            // Split the input value into integer and decimal parts
            const parts = inputVal.split('.');
            let integerPart = parts[0];
            const decimalPart = parts[1] ? parts[1].substring(0, 2) : '';

            // Format the integer part with commas
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Combine the integer and decimal parts
            inputVal = decimalPart ? `${integerPart}.${decimalPart}` : integerPart;

            // Set the formatted value back to the input
            input.val(inputVal);

            // Adjust the caret position
            const originalLen = inputVal.length;
            let caretPos = input.prop("selectionStart");
            const updatedLen = inputVal.length;
            caretPos = updatedLen - originalLen + caretPos;
            input[0].setSelectionRange(caretPos, caretPos);
        }
        $(document).ready(function() {
            // Initialize Selectize
            $('select').selectize({
                sortField: 'text'
            });

            // Enforce minimum quantity of 1
            $(document).on('input', '.qty', function() {
                const qty = Math.max(parseInt($(this).val()) || 1, 1);
                $(this).val(qty);
            });

            // Initialize DataTable with default page length
            const table = $('#example1').DataTable({
                scrollX: true, // Enables horizontal scrolling
                autoWidth: false, // Prevents automatic width calculation
                columnDefs: [{
                        width: '150px',
                        targets: 0
                    },
                    {
                        width: '50px',
                        targets: 1
                    },
                    {
                        width: '30px',
                        targets: 2
                    },
                    {
                        width: '70px',
                        targets: [3, 4, 5, 6, 7]
                    },
                    {
                        width: '30px',
                        targets: 8
                    }
                ]
            });

            // Add item to the cart
            // Add item to the cart
            $(document).on('click', '.tambah-ke-keranjang', function() {
                const price = $(this).data("harga_jual");
                const defaultQty = 1;
                const subtotal = price * defaultQty;

                const data = [
                    escapeHtml($(this).data("nama_barang")),
                    $(this).data("satuan"),
                    $(this).data("stok"),
                    formatNumber(price),
                    defaultQty, // Default quantity
                    0, // Default discount percent
                    0, // Default discount amount
                    formatNumber(subtotal), // Calculate subtotal
                ];

                const rowHtml = `
    <tr>
        <td><input type="text" class="form-control fw-bold" name="nama_barang[]" value="${data[0]}" readonly></td>
        <td>${data[1]}</td>
        <td>${data[2]}</td>
        <td><input type="text" class="form-control fw-bold" name="harga_jual[]" value="${data[3]}" readonly></td>
        <td><input type="number" class="form-control fw-bold qty" name="qty[]" value="${data[4]}" min="1"></td>
        <td><input type="number" class="form-control discount-percent fw-bold" name="disc_perc[]" value="${data[5]}" min="0" max="100"></td>
        <td><input type="number" class="form-control discount-rp fw-bold" name="disc_rp[]" value="${data[6]}" min="0" step="500"></td>
        <td><input type="text" class="form-control subtotal fw-bold text-primary fs-6" name="subtotal[]" value="${data[7]}" readonly></td>
        <td><button class="btn btn-sm btn-danger text-white hapus-baris"><i class="bi bi-trash"></i></button></td>
    </tr>`;
                table.row.add($(rowHtml)).draw();
                updateTotal();
            });


            // Remove row from the cart
            $(document).on('click', '.hapus-baris', function() {
                table.row($(this).closest('tr')).remove().draw();
                updateTotal();
            });

            // Update subtotal and total when quantity, discount percent, or discount amount changes
            $(document).on('input', '.qty, .discount-percent, .discount-rp', function() {
                const row = $(this).closest('tr');
                const qty = Math.max(parseInt(row.find('.qty').val()) || 1, 1);
                const price = parseFloat(removeCommas(row.find('[name="harga_jual[]"]').val())) || 0;
                const discountPercent = parseFloat(row.find('.discount-percent').val()) || 0;
                const discountAmount = parseFloat(row.find('.discount-rp').val()) || 0;

                // Update subtotal
                let subtotal = qty * price - discountAmount;
                subtotal -= subtotal * (discountPercent / 100);
                row.find('.subtotal').val(formatNumber(subtotal));

                updateTotal();
            });

            // Update total and change due
            function updateTotal() {
                let total = 0;
                table.rows().every(function() {
                    const row = this.node();
                    total += parseFloat(removeCommas($(row).find('.subtotal').val())) || 0;
                });

                $('.total').val(formatNumber(total));

                const payment = parseFloat(removeCommas($('#bayar').val())) || 0;
                $('#kembalian').val(formatNumber(payment - total));
            }

            // Calculate change when payment is updated
            $('#bayar').on('input', function() {
                updateTotal();
            });

            // Format currency fields
            $("input[data-type='currency']").on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), true);
                }
            });
        });
    </script>
@endsection
