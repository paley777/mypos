@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <style>
        .highlight-danger {
            background-color: #f8d7da !important;
        }

        .highlight-primary {
            background-color: #cce5ff !important;
        }

        .highlight-info {
            background-color: #d1ecf1 !important;
        }

        .highlight-warning {
            background-color: #fff3cd !important;
        }
    </style>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Penjualan</h1>
                    </div>
                </div><!--//row-->
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-3">
                            <div class="app-card-body p-3 d-flex justify-content-between align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-danger" id="PenghasilanKotor">
                                        Penghasilan Kotor
                                    </button>
                                    <button class="btn btn-primary" id="PenghasilanBersih">
                                        Profit
                                    </button>
                                    <button class="btn btn-info" id="Bayar">
                                        Bayar Kontan
                                    </button>
                                    <button class="btn btn-warning" id="Piutang">
                                        Piutang
                                    </button>
                                </div>
                                <div>
                                    <h2>Total : Rp100.000</h2>
                                </div>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive p-4">
                                    <table border="0" cellspacing="5" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td>Date:</td>
                                                <td><input type="text" id="date" name="date"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="example" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No.</th>
                                                <th class="cell">Kode Invoice</th>
                                                <th class="cell">Tanggal</th>
                                                <th class="cell">Sales</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Bayar</th>
                                                <th class="cell">Sisa Bayar</th>
                                                <th class="cell">Jatuh Tempo</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $key => $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaction->kode_inv }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    <td>{{ $transaction->nama_petugas }}</td>
                                                    <td>{{ $transaction->nama_pelanggan }}</td>
                                                    <td>{{ $transaction->status }}</td>
                                                    <td>@currency($transaction->bayar)</td>
                                                    <td>@currency($transaction->sisa_bayar)</td>
                                                    <td>{{ $transaction->jatuh_tempo }}</td>
                                                    <td>@currency($transaction->total)</td>
                                                    <td>@currency($transaction->profit)</td>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
    <script>
        var selectedDate;
        var previousColumnIndex = null;

        // Custom filtering function which will search data in column four for a specific date
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var date = selectedDate.val();
                var rowDate = new Date(data[2]); // Assuming the Tanggal column is at index 2

                if (date === null || rowDate.toDateString() === new Date(date).toDateString()) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {

            // Create date input
            selectedDate = new DateTime($('#date'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialization
            var table = $('#example').DataTable({
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
                            columns: ':visible',
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, 'colvis'
                ]
            });

            // Refilter the table based on date input
            $('#date').on('change', function() {
                table.draw();
                calculateAndDisplayTotal(); // Update the total whenever the date is changed
            });

            // Event listeners for button clicks with visual feedback
            $('#PenghasilanKotor, #PenghasilanBersih, #Bayar, #Piutang').on('click', function() {
                // Remove 'active' class from all buttons
                $('#PenghasilanKotor, #PenghasilanBersih, #Bayar, #Piutang').removeClass(
                    'active text-white');

                // Add 'active' class to the clicked button
                $(this).addClass('active text-white');

                // Calculate total based on clicked button
                var column;
                var columnIndex;
                var highlightClass;
                if (this.id === 'PenghasilanKotor') {
                    column = 'total';
                    columnIndex = 9;
                    highlightClass = 'highlight-danger';
                } else if (this.id === 'PenghasilanBersih') {
                    column = 'profit';
                    columnIndex = 10;
                    highlightClass = 'highlight-primary';
                } else if (this.id === 'Bayar') {
                    column = 'bayar';
                    columnIndex = 6;
                    highlightClass = 'highlight-info';
                } else if (this.id === 'Piutang') {
                    column = 'piutang';
                    columnIndex = 7;
                    highlightClass = 'highlight-warning';
                }

                // Remove previous highlighting
                if (previousColumnIndex !== null) {
                    table.column(previousColumnIndex).nodes().to$().removeClass(
                        'highlight-danger highlight-primary highlight-info highlight-warning');
                }

                // Highlight the new column
                table.column(columnIndex).nodes().to$().addClass(highlightClass);

                // Update previousColumnIndex
                previousColumnIndex = columnIndex;

                calculateAndDisplayTotal(column);
            });

            // Function to calculate and display the total based on the column
            function calculateAndDisplayTotal(column) {
                var total = 0;

                // Loop through each filtered row and sum the specified column
                table.rows({
                    search: 'applied'
                }).every(function() {
                    var rowData = this.data();

                    // Get the column index based on the column name
                    var columnIndex;
                    if (column === 'total') columnIndex = 9;
                    else if (column === 'profit') columnIndex = 10;
                    else if (column === 'bayar') columnIndex = 6;
                    else if (column === 'piutang') columnIndex = 7;

                    // Extract and parse the column value, removing any currency formatting
                    var value = parseFloat(rowData[columnIndex].replace(/[^\d]/g, '')) || 0;
                    total += value;
                });

                // Format and display the total
                var formattedTotal = total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                $('h2').text('Total: ' + formattedTotal);
            }

            // Initial calculation when page loads
            $('#Bayar').trigger('click');
        });
    </script>
@endsection
