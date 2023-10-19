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
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                        <path fill-rule="evenodd"
                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                    </svg>
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
                    <div class="app-card-body p-4">
                        <form class="row g-2" method="post" action="/dashboard/barang-masuk">
                            @csrf
                            <div class="col-md-6 position-relative">
                                <label for="validationCustom01" class="form-label ">Nama Supplier<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="nama_supplier" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->nama }}">{{ $supplier->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="validationCustom01" class="form-label ">Nama Barang<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="nama_barang" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }} |
                                            {{ $barang->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 position-relative">
                                <label for="validationCustom01" class="form-label">Jumlah Beli<span
                                        class="text-danger">*</span></label>
                                <input type="number" onkeypress="return event.charCode >= 48" id="inp2" min="1"
                                    class="form-control" name="jumlah_beli" placeholder="Isi Jumlah Beli" required>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationCustom01" class="form-label">Harga Beli Satuan<span
                                        class="text-danger">*</span></label>
                                <input type="number" onkeypress="return event.charCode >= 48" id="inp" min="1"
                                    class="form-control" name="harga_beli_satuan" placeholder="Isi Harga Beli Satuan"
                                    required>
                            </div>
                            <div class="col-md-4 position-relative justify-content-center">
                                <label for="validationCustom01" class="form-label">Jumlah Beli x Harga Beli Satuan = Harga
                                    Beli Total<span class="text-danger">*</span></label>
                                <button class="btn app-btn-primary" type="button" onclick="hitungTotal()">Hitung Total</button>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationCustom01" class="form-label">Harga Beli Total<span
                                        class="text-danger">*</span></label>
                                <input type="number" onkeypress="return event.charCode >= 48" id="inp1" min="1"
                                    class="form-control" name="harga_beli_total" placeholder="Isi Harga Beli Total"
                                    required>
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
    <script>
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
            var angka1 = parseFloat(document.getElementById("inp2").value);
            var angka2 = parseFloat(document.getElementById("inp").value);

            // Hitung totalnya
            var total = angka1 * angka2;

            // Tampilkan total di dalam elemen span dengan id "total"
            document.getElementById("inp1").value = total;
        }
    </script>
@endsection
