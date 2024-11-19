@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Barang Keluar</h1>
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
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive p-4">
                                    <div class="mb-2" style="display: flex; align-items: center; gap: 10px;">
                                        <div>
                                            <label for="min">Minimum Date:</label>
                                            <input type="text" id="min" name="min" class="form-control">
                                        </div>
                                        <div>
                                            <label for="max">Maximum Date:</label>
                                            <input type="text" id="max" name="max" class="form-control">
                                        </div>
                                    </div>
                                    <div class="table-responsive p-4">
                                        <table id="example" class="table table-hover table-bordered mb-0">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="cell">No.</th>
                                                    <th class="cell">Created_At</th>
                                                    <th class="cell">Waktu Keluar</th>
                                                    <th class="cell">Kode Invoice</th>
                                                    <th class="cell">Nama Barang</th>
                                                    <th class="cell">Satuan</th>
                                                    <th class="cell">Jumlah Jual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($barangkeluars as $key => $barangkeluar)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $barangkeluar->created_at }}</td>
                                                        <td>{{ $barangkeluar->created_at->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ $barangkeluar->kode_inv }}</td>
                                                        <td>{{ $barangkeluar->nama_barang }}</td>
                                                        <td>{{ $barangkeluar->satuan }}</td>
                                                        <td>{{ $barangkeluar->jumlah_keluar }}</td>
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
    </div>
    <style>
        /* Add spacing for search bar */
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 1rem;
        }
    </style>
    <script>
        var minDate, maxDate;
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[1]);
                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });
            var table = $('#example').DataTable({
                scrollX: true, // Enables horizontal scrolling
                "order": [
                    [1, "desc"]
                ],
                "columnDefs": [{
                    "orderable": false,
                    "searchable": false,
                    "targets": 0
                }],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari _MAX_ total data)"
                },
                "drawCallback": function(settings) {
                    var api = this.api();
                    api.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });
            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
@endsection
