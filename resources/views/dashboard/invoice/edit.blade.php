@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Invoice</h1>
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
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                        <path fill-rule="evenodd"
                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </div><!--//app-icon-holder-->
                            </div><!--//col-->
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <div class="notification-type mb-2"><span class="badge bg-primary">Edit Invoice</span></div>
                                <h4 class="notification-title mb-1">Formulir Ubah Invoice</h4>
                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Update</li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">System</li>
                                </ul>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <form class="row g-2" method="post" action="/dashboard/invoice/{{ $transaction->id }}/update">
                            @csrf
                            <div class="col-md-4 position-relative">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" readonly name="nama_pelanggan" required>
                                    @foreach ($allPelanggan as $pelanggan)
                                        <option value="{{ $pelanggan->nama }}"
                                            {{ $transaction->nama_pelanggan == $pelanggan->nama ? 'selected' : '' }}>
                                            {{ $pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option value="LUNAS" {{ $transaction->status == 'LUNAS' ? 'selected' : '' }}>LUNAS
                                    </option>
                                    <option value="HUTANG" {{ $transaction->status == 'HUTANG' ? 'selected' : '' }}>HUTANG
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="jatuh_tempo" class="form-label">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="jatuh_tempo"
                                    value="{{ $transaction->jatuh_tempo }}">
                            </div>
                            <div class="col-md-12 position-relative">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" required>{{ $transaction->keterangan }}</textarea>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="total" class="form-label">Total<span class="text-danger">*</span></label>
                                <input data-type="currency" type="text" readonly class="form-control" name="total"
                                    value="{{ $transaction->total }}" required>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="bayar" class="form-label">Bayar<span class="text-danger">*</span></label>
                                <input data-type="currency" type="text" class="form-control" name="bayar"
                                    value="{{ $transaction->bayar }}" required>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="kembalian" class="form-label">Kembalian/sisa bayar<span
                                        class="text-danger">*</span></label>
                                <input data-type="currency" type="text" class="form-control" name="kembalian"
                                    value="{{ $transaction->kembalian }}" required>
                            </div>
                            <div class="col-md-12">
                                <h4>Orders</h4>
                                <table id="ordersTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Qty</th>
                                            <th>Disc %</th>
                                            <th>Disc Rp</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><input type="text" class="form-control" name="nama_barang[]"
                                                        value="{{ $order->nama_barang }}" readonly></td>
                                                <td><input type="number" class="form-control" name="harga_jual[]"
                                                        value="{{ $order->harga_jual }}" readonly></td>
                                                <td><input type="number" class="form-control" id="inp1"
                                                        name="qty[]" value="{{ $order->qty }}" required></td>
                                                <td><input type="number" class="form-control" name="disc_perc[]"
                                                        value="{{ $order->disc_perc }}" required></td>
                                                <td><input type="number" class="form-control" name="disc_rp[]"
                                                        value="{{ $order->disc_rp }}" required></td>
                                                <td><input data-type="currency" type="text" class="form-control"
                                                        name="subtotal[]" value="{{ $order->subtotal }}" readonly></td>
                                                <td><button type="button"
                                                        class="btn btn-danger text-white remove-order">Hapus</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <button type="button" class="btn btn-primary text-white" id="addOrder">Tambah Order</button> --}}
                            </div>
                            <p>(Wajib terisi untuk kolom dengan tanda "<span class="text-danger">*</span>").</p>

                            <div class="app-card-footer px-4 py-3">
                                <button class="btn app-btn-primary" type="submit">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                                stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                        </g>
                                    </svg> Simpan Data
                                </button>
                                <a class="btn btn-danger text-white"
                                    href="/dashboard/invoice/{{ $transaction->id }}/rombak">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                                stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                        </g>
                                    </svg>
                                    Rombak Invoice
                                </a>
                            </div>
                        </form>

                    </div><!--//app-card-body-->
                </div><!--//app-card-footer-->
            </div><!--//app-card-->
        </div>
    </div>

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

    <script>
        $(document).ready(function() {
            function calculateSubtotal(row) {
                var harga_jual = parseFloat(row.find('input[name="harga_jual[]"]').val()) || 0;
                var qty = parseInt(row.find('input[name="qty[]"]').val()) || 0;
                var disc_perc = parseFloat(row.find('input[name="disc_perc[]"]').val()) || 0;
                var disc_rp = parseFloat(row.find('input[name="disc_rp[]"]').val()) || 0;

                var subtotal = (harga_jual * qty) - ((harga_jual * qty) * (disc_perc / 100)) - disc_rp;
                row.find('input[name="subtotal[]"]').val(formatNumberWithCommas(subtotal));
                calculateTotal();
            }

            function calculateTotal() {
                var total = 0;
                $('#ordersTable tbody tr').each(function() {
                    var subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val().replace(/,/g,
                        '')) || 0;
                    total += subtotal;
                });

                // Update total field
                $('input[name="total"]').val(formatNumberWithCommas(total));

                // Recalculate kembalian based on updated total and bayar
                var bayar = parseFloat($('input[name="bayar"]').val().replace(/,/g, '')) || 0;
                var kembalian = bayar - total;
                $('input[name="kembalian"]').val(formatNumberWithCommas(kembalian));
            }


            // Function to format numbers with commas
            function formatNumber(n) {
                return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Event listeners
            $('#ordersTable').on('input',
                'input[name="harga_jual[]"], input[name="qty[]"], input[name="disc_perc[]"], input[name="disc_rp[]"]',
                function() {
                    calculateSubtotal($(this).closest('tr'));

                });

            $('input[name="bayar"]').on('input', function() {
                var total = parseFloat($('input[name="total"]').val().replace(/,/g, '')) || 0;
                var bayar = parseFloat($(this).val().replace(/,/g, '')) || 0;
                var kembalian = bayar - total;
                $('input[name="kembalian"]').val(formatNumberWithCommas(kembalian));
            });


            $('#addOrder').on('click', function() {
                var newRow = `<tr>
            <td><input type="text" class="form-control" name="nama_barang[]" required></td>
            <td><input type="number" class="form-control" name="harga_jual[]" required></td>
            <td><input type="number" class="form-control" name="qty[]" required></td>
            <td><input type="number" class="form-control" name="disc_perc[]" required></td>
            <td><input type="number" class="form-control" name="disc_rp[]" required></td>
            <td><input type="number" class="form-control" name="subtotal[]" readonly></td>
            <td><button type="button" class="btn btn-danger text-white remove-order">Hapus</button></td>
        </tr>`;
                $('#ordersTable tbody').append(newRow);
            });

            $(document).on('click', '.remove-order', function() {
                $(this).closest('tr').remove();
                calculateTotal();
            });

            function formatNumberWithCommas(number) {
                return number.toLocaleString('en-US');
            }

            function removeCommas(str) {
                return str.replace(/,/g, '');
            }

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
        });
    </script>

@endsection
