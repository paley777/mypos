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
                                    <!-- SVG icon code -->
                                </div><!--//app-icon-holder-->
                            </div><!--//col-->
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <div class="notification-type mb-2"><span class="badge bg-primary">Olah Data</span></div>
                                <h4 class="notification-title mb-1">Formulir Barang Baru</h4>

                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Create</li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">System</li>
                                </ul>

                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <form class="row g-2" method="post" action="/dashboard/regis-barang">
                            @csrf
                            <div class="col-md-5 position-relative">
                                <label for="validationCustom01" class="form-label ">Nama Barang<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="validationCustom01" class="form-control" name="nama_barang"
                                    placeholder="Isi Nama Barang" required>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationCustom02" class="form-label">Satuan<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="validationCustom02" class="form-control" name="satuan"
                                    placeholder="Isi Satuan" required>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="modal" class="form-label">Modal Per Satuan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="modal" id="modal" value=""
                                    data-type="currency" placeholder="Rp." required>
                            </div>
                            <div class="col-md-2 position-relative">
                                <label for="harga_jual" class="form-label">Harga Jual<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual" value=""
                                    data-type="currency" placeholder="Rp." required>
                            </div>
                            <p>
                                (Wajib terisi untuk kolom dengan tanda "<span class="text-danger">*</span>").
                            </p>
                    </div><!--//app-card-body-->
                    <div class="app-card-footer px-4 py-3">
                        <button class="btn app-btn-primary" type="submit">
                            <!-- Button icon -->
                            Simpan Data
                        </button>
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
