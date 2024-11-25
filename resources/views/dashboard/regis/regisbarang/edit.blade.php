@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Registrasi Barang</h1>
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
                                <h4 class="notification-title mb-1">Formulir Ubah Barang</h4>

                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Update</li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">System</li>
                                </ul>

                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4" style="background-color: #f9f9f9;">
                        <form class="row g-3 px-4 py-2" method="post" action="/dashboard/regis-barang/{{ $barang->id }}">
                            @method('put')
                            @csrf
                            <!-- Nama Barang -->
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label text-dark fw-bold">Nama Barang <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-box-seam"></i>
                                    </span>
                                    <input type="text" id="nama_barang" class="form-control" name="nama_barang"
                                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                                        placeholder="Contoh: Laptop, Buku" required>
                                </div>
                            </div>

                            <!-- Satuan -->
                            <div class="col-md-6">
                                <label for="satuan" class="form-label text-dark fw-bold">Satuan <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-tags"></i>
                                    </span>
                                    <input type of="text" id="satuan" class="form-control" name="satuan"
                                        value="{{ old('satuan', $barang->satuan) }}" placeholder="Contoh: Pcs, Kg" required>
                                </div>
                            </div>

                            <!-- Modal Per Satuan -->
                            <div class="col-md-6">
                                <label for="modal" class="form-label text-dark fw-bold">Modal Per Satuan <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="text" id="modal" class="form-control" name="modal"
                                        value="{{ old('modal', $barang->modal) }}" data-type="currency"
                                        placeholder="Misal 100,000" required>
                                </div>
                            </div>

                            <!-- Harga Jual -->
                            <div class="col-md-6">
                                <label for="harga_jual" class="form-label text-dark fw-bold">Harga Jual <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="text" id="harga_jual" class="form-control" name="harga_jual"
                                        value="{{ old('harga_jual', $barang->harga_jual) }}" data-type="currency"
                                        placeholder="Misal 120,000" required>
                                </div>
                            </div>

                            <!-- Informasi Wajib -->
                            <div class="col-12 text-muted mt-2">
                                <small>(Kolom bertanda <span class="text-danger">*</span> wajib diisi).</small>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 py-3 fw-bold text-white" type="submit">
                                    <i class="bi bi-send me"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div><!--//app-card-footer-->
                </div><!--//app-card-->
            </div>
        </div>
    </div>
    <!-- Existing scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Additional scripts -->
    <script>
        // Function to parse currency formatted string to numeric value
        function parseCurrency(value) {
            // Remove any non-digit characters
            return parseFloat(value.replace(/[^0-9.-]+/g, ""));
        }

        // Add event listener to 'harga_jual' input
        document.getElementById('harga_jual').addEventListener('blur', function() {
            var modalInput = document.getElementById('modal');
            var hargaJualInput = document.getElementById('harga_jual');

            var modalValue = parseCurrency(modalInput.value);
            var hargaJualValue = parseCurrency(hargaJualInput.value);

            if (hargaJualValue < modalValue) {
                alert('Harga jual tidak boleh kurang dari harga modal!');
                hargaJualInput.value = modalInput.value; // Set harga_jual equal to modal
                hargaJualInput.focus();
            }
        });
    </script>
    <!-- Existing scripts -->
    <script>
        // Jquery Dependency

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += "";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
    </script>
@endsection
