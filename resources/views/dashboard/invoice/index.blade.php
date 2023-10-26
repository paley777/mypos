@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Invoice</h1>
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
                                @if (Auth::user()->role == 'Super Administrator')
                                    <div class="table-responsive p-4">
                                        <table id="example" class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">No.</th>
                                                    <th class="cell">Kode Invoice</th>
                                                    <th class="cell">Tanggal</th>
                                                    <th class="cell">Sales</th>
                                                    <th class="cell">Customer</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell">Jatuh Tempo</th>
                                                    <th class="cell">Keterangan</th>
                                                    <th class="cell">Total</th>
                                                    <th class="cell">Profit</th>
                                                    <th class="cell">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as $key => $transaction)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $transaction->kode_inv }}</td>
                                                        <td>{{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                                        <td>{{ $transaction->nama_petugas }}</td>
                                                        <td>{{ $transaction->nama_pelanggan }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->jatuh_tempo }}</td>
                                                        <td>{{ $transaction->keterangan }}</td>
                                                        <td>@currency($transaction->total)</td>
                                                        <td>@currency($transaction->profit)</td>
                                                        <td> <a target="_blank"
                                                                href="/dashboard/invoice/{{ $transaction->id }}/print"
                                                                class="btn btn-sm btn-warning"><svg width="16px"
                                                                    height="16px" viewBox="0 0 24 24"
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
                                                                                        stroke="#000000"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"></polygon>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </svg> Cetak Invoice</a>
                                                            @if ($transaction->status == 'HUTANG')
                                                                <a href="/dashboard/invoice/{{ $transaction->id }}/lunas"
                                                                    class="btn btn-sm btn-warning"><svg width="16px"
                                                                        height="16px" viewBox="0 0 24 24"
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
                                                                                            stroke="#000000"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"></polygon>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg> Lunaskan</a>
                                                            @endif
                                                            <form action="/dashboard/invoice/{{ $transaction->id }}"
                                                                method="post" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger text-white"
                                                                    onclick="return confirm('Anda yakin untuk menghapus data ini?')">
                                                                    <svg width="16px" height="16px"
                                                                        viewBox="0 0 1024 1024"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                        <g id="SVGRepo_tracerCarrier"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </g>
                                                                        <g id="SVGRepo_iconCarrier">
                                                                            <path fill="#ffffff"
                                                                                d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z">
                                                                            </path>
                                                                        </g>
                                                                    </svg> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                @else
                                    <div class="table-responsive p-4">
                                        <table id="example" class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">No.</th>
                                                    <th class="cell">Kode Invoice</th>
                                                    <th class="cell">Tanggal</th>
                                                    <th class="cell">Sales</th>
                                                    <th class="cell">Customer</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell">Jatuh Tempo</th>
                                                    <th class="cell">Keterangan</th>
                                                    <th class="cell">Total</th>
                                                    <th class="cell">Profit</th>
                                                    <th class="cell">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as $key => $transaction)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $transaction->kode_inv }}</td>
                                                        <td>{{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ $transaction->nama_petugas }}</td>
                                                        <td>{{ $transaction->nama_pelanggan }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->jatuh_tempo }}</td>
                                                        <td>{{ $transaction->keterangan }}</td>
                                                        <td>@currency($transaction->total)</td>
                                                        <td>@currency($transaction->profit)</td>
                                                        <td> <a target="_blank"
                                                                href="/dashboard/invoice/{{ $transaction->id }}/print"
                                                                class="btn btn-sm btn-warning"><svg width="16px"
                                                                    height="16px" viewBox="0 0 24 24"
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
                                                                                        stroke="#000000"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"></polygon>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </svg> Cetak Invoice</a>
                                                            @if ($transaction->status == 'HUTANG')
                                                                <a href="/dashboard/invoice/{{ $transaction->id }}/lunas"
                                                                    class="btn btn-sm btn-warning"><svg width="16px"
                                                                        height="16px" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                        <g id="SVGRepo_tracerCarrier"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"></g>
                                                                        <g id="SVGRepo_iconCarrier">
                                                                            <title></title>
                                                                            <g id="Complete">
                                                                                <g id="edit">
                                                                                    <g>
                                                                                        <path
                                                                                            d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                                            fill="none"
                                                                                            stroke="#000000"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"></path>
                                                                                        <polygon fill="none"
                                                                                            points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                                            stroke="#000000"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"></polygon>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg> Lunaskan</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                @endif
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
