@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Barang Masuk</h1>
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
                                <h4 class="notification-title mb-1">Formulir Barang Masuk Baru</h4>
                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Create</li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">System</li>
                                </ul>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4" style="background-color: #f9f9f9;">
                        <form class="row g-3 px-4 py-2" method="post" action="/dashboard/barang-masuk">
                            @csrf
                            <div class="col-md-4 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Nama Penerima<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control" name="nama_penerima"
                                        placeholder="Isi Nama Penerima" value="{{ Auth::user()->nama }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Nama Supplier<span
                                        class="text-danger">*</span></label>
                                <select name="nama_supplier" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->nama }}">{{ $supplier->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Nama Barang<span
                                        class="text-danger">*</span></label>
                                <select name="nama_barang" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }} |
                                            {{ $barang->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Jumlah Beli<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-boxes"></i>
                                    </span>
                                    <input type="number" onkeypress="return event.charCode >= 48" id="inp2"
                                        min="1" class="form-control" name="jumlah_beli" placeholder="Isi Jumlah Beli"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Harga Beli Satuan<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-box"></i>
                                    </span>
                                    <input type="text" data-type="currency" onkeypress="return event.charCode >= 48"
                                        id="inp" min="1" class="form-control" name="harga_beli_satuan"
                                        placeholder="Isi Harga Beli Satuan" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="validationCustom01" class="form-label text-dark fw-bold"></label>
                                <br>
                                <button class="btn app-btn-primary" type="button" onclick="hitungTotal()"><i class="bi bi-pencil"></i> Hitung
                                    Total</button>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationCustom01" class="form-label text-dark fw-bold">Harga Beli Total<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-cart"></i>
                                    </span>
                                    <input type="text" data-type="currency" onkeypress="return event.charCode >= 48"
                                        id="inp1" min="1" class="form-control" name="harga_beli_total"
                                        placeholder="Isi Harga Beli Total" required>
                                </div>
                            </div>
                            <!-- New Keterangan Input -->
                            <div class="col-md-9 position-relative">
                                <label for="keterangan" class="form-label text-dark fw-bold">Keterangan</label>
                                <textarea rows="4" style="height: 80px;" id="keterangan" class="form-control" name="keterangan"
                                    placeholder="Isi Keterangan"></textarea>
                            </div>
                            <!-- New Status Input -->
                            <div class="col-md-3 position-relative">
                                <label for="status" class="form-label text-dark fw-bold">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="LUNAS">LUNAS</option>
                                    <option value="HUTANG">HUTANG</option>
                                </select>
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
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg> Simpan Data
                        </button>
                        </form>
                    </div><!--//app-card-footer-->
                </div><!--//app-card-->
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <script>
        $('select').selectize({
            sortField: 'text'
        });

        document.getElementById("inp").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
        });
        $("#inp").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "1")
            }
        })
    </script>
    <script>
        document.getElementById("inp2").addEventListener("keydown", function(event) {
            if (event.key === "e" || event.key === "E") {
                event.preventDefault();
            }
        });

        document.getElementById("inp2").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
        });
        $("#inp2").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "1")
            }
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
    <script>
        document.getElementById("inp2").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
        });
        $("#inp2").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "1")
            }
        })
    </script>
    <script>
        function hitungTotal() {
            // Ambil nilai dari input angka 1 dan angka 2
            var angka1 = parseFloat(document.getElementById("inp2").value.replace(/,/g, ''));
            var angka2 = parseFloat(document.getElementById("inp").value.replace(/,/g, ''));

            // Hitung totalnya
            var total = angka1 * angka2;

            // Tampilkan total di dalam elemen span dengan id "total"
            document.getElementById("inp1").value = total;
            formatCurrency($("#inp1"));
        }
    </script>

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
                input_val = +left_side + "." + right_side;

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
