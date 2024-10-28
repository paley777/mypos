@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Piutang</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive p-4">
                                    <table id="example" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No.</th>
                                                <th class="cell">Kode Invoice</th>
                                                <th class="cell">Tanggal</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Jatuh Tempo</th>
                                                <th class="cell">Total Pembelian</th>
                                                <th class="cell">Sisa Bayar</th>
                                                <th class="cell">Telah Bayar</th>
                                                <th class="cell">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($piutangs as $key => $piutang)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $piutang->kode_inv }}</td>
                                                    <td>{{ $piutang->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                                    <td>{{ $piutang->nama_pelanggan }}</td>
                                                    <td>{{ $piutang->jatuh_tempo }}</td>
                                                    <td>@currency($piutang->harga_asli)</td>
                                                    <td>@currency($piutang->sisa_bayar)</td>
                                                    <td>@currency($piutang->harga_asli - abs($piutang->sisa_bayar))</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning text-black bayar-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-total="{{ $piutang->harga_asli }}"
                                                            data-sisa="{{ $piutang->sisa_bayar }}">
                                                            <svg width="16px" height="16px" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <title></title>
                                                                    <g id="Complete">
                                                                        <g id="edit">
                                                                            <g>
                                                                                <path
                                                                                    d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                                    fill="none" stroke="#000000"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"></path>
                                                                                <polygon fill="none"
                                                                                    points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                                    stroke="#000000" stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"></polygon>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg> Bayar
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Hutang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/piutang/bayar" method="post">
                        @csrf
                        {{-- Kode Invoice --}}
                        <div class="position-relative">
                            <label for="validationCustom01" class="form-label">Kode Invoice</label>
                            <input type="text" id="kode_inv" class="form-control form-control-lg" name="kode_inv"
                                required readonly>
                        </div>

                        <div class="position-relative">
                            <label for="validationCustom01" class="form-label">Bayar<span
                                    class="text-danger">*</span></label>
                            <input data-type='currency' type="text" id="bayar" value="0"
                                class="form-control form-control-lg" name="bayar" required>
                        </div>
                        {{-- Sisa Bayar --}}
                        <div class="position-relative">
                            <label for="validationCustom01" class="form-label">Sisa Bayar</label>
                            <input data-type='currency' type="text" id="sisa_bayar" value="0"
                                class="form-control form-control-lg" name="sisa_bayar" required readonly>
                        </div>

                        {{-- button submit --}}
                        <div class="d-grid mt-3">
                            <button type="submit" class=" text-white btn btn-primary btn-lg"
                                id="submit-btn">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            // Show modal and populate fields
            $('.bayar-btn').on('click', function() {
                var sisa = parseFloat($(this).data('sisa'));
                $('#bayar').val(0);
                $('#sisa_bayar').val(formatNumberWithCommas(Math.abs(sisa)));
                $('#bayar').data('sisa', sisa);
                $('#submit-btn').prop('disabled', false); // Enable the submit button initially
                $('#kode_inv').val($(this).closest('tr').find('td:eq(1)').text());

                // Reset the form when the modal is closed
                $('#editModal').on('hidden.bs.modal', function() {
                    $('#bayar').val(0);
                    $('#sisa_bayar').val(0);
                    $('#bayar').data('sisa', 0);
                    $('#submit-btn').prop('disabled', false);
                });
            });

            // Update Sisa Bayar when Bayar input changes
            $('#bayar').on('input', function() {
                var bayar = parseFloat($(this).val().replace(/,/g, '')) || 0;
                var sisa = Math.abs(parseFloat($(this).data('sisa'))); // Convert negative sisa to positive

                // Calculate the new sisa bayar
                var newSisa = sisa - bayar;


                $('#sisa_bayar').val(formatNumberWithCommas(newSisa));


                // Disable the submit button if bayar exceeds sisa
                if (bayar > sisa) {
                    $('#submit-btn').prop('disabled', true);
                } else {
                    $('#submit-btn').prop('disabled', false);
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

        function formatNumberWithCommas(number) {
            return number.toLocaleString('en-US');
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
