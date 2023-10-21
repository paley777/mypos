@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Barang Masuk</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                   
                                </div>
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                   
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
                                                <th class="cell">Waktu Masuk</th>
                                                <th class="cell">Penerima</th>
                                                <th class="cell">Nama Supplier</th>
                                                <th class="cell">Nama Barang</th>
                                                <th class="cell">Satuan</th>
                                                <th class="cell">Jumlah Beli</th>
                                                <th class="cell">Harga Beli Satuan</th>
                                                <th class="cell">Harga Beli Total</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barangmasuks as $key => $barangmasuk)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $barangmasuk->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                                    <td>{{ $barangmasuk->nama_penerima }}</td>
                                                    <td>{{ $barangmasuk->nama_supplier }}</td>
                                                    <td>{{ $barangmasuk->nama_barang }}</td>
                                                    <td>{{ $barangmasuk->satuan }}</td>
                                                    <td>{{ $barangmasuk->jumlah_beli }}</td>
                                                    <td>@currency($barangmasuk->harga_beli_satuan)</td>
                                                    <td>@currency($barangmasuk->harga_beli_total)</td>
                                                   
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }, 'colvis'
                    ]

                });
            });
    </script>
@endsection
