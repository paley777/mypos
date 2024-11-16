<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\StokBarang;
use App\Models\Transaction;
use App\Models\Piutang;
use App\Models\Order;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function barang_masuk()
    {
        return view('dashboard.report.barangmasuk', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'barangmasuks' => BarangMasuk::orderBy('nama_barang', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function barang_keluar()
    {
        return view('dashboard.report.barangkeluar', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'barangkeluars' => BarangKeluar::orderBy('kode_inv', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function stok_barang()
    {
        return view('dashboard.report.stokbarang', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'stokbarangs' => StokBarang::orderBy('nama_barang', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function invoice()
    {
        return view('dashboard.report.invoice', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'transactions' => Transaction::get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function order()
    {
        return view('dashboard.report.order', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'orders' => Order::get(),
        ]);
    }


    public function daily(Request $request)
    {
        $transactions = Transaction::leftJoin('piutangs', 'transactions.kode_inv', '=', 'piutangs.kode_inv')
            ->select('transactions.*', 'piutangs.sisa_bayar')
            ->get();

        foreach ($transactions as $transaction) {
            if ($transaction->status != 'HUTANG') {
                $transaction->bayar -= $transaction->kembalian;
            }
        }

        return view('dashboard.report.penjualan', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'transactions' => $transactions,
        ]);
    }
}
