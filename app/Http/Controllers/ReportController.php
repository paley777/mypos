<?php

/**
 * ReportController
 *
 * This controller handles the generation and display of various reports, including stock reports,
 * transaction histories, and daily sales summaries. It provides filtered and sorted data views
 * for analysis and decision-making.
 */

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
     * Display the report for incoming goods (Barang Masuk).
     *
     * Shows a list of incoming goods records, optionally filtered by search.
     *
     * @return \Illuminate\View\View
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
     * Display the report for outgoing goods (Barang Keluar).
     *
     * Shows a list of outgoing goods records, optionally filtered by search.
     *
     * @return \Illuminate\View\View
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
     * Display the report for stock items.
     *
     * Shows a list of all stock items, optionally filtered by search.
     *
     * @return \Illuminate\View\View
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
     * Display the report for invoices.
     *
     * Shows a list of all transactions (invoices).
     *
     * @return \Illuminate\View\View
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
     * Display the report for orders.
     *
     * Shows a list of all orders associated with transactions.
     *
     * @return \Illuminate\View\View
     */
    public function order()
    {
        return view('dashboard.report.order', [
            'active' => 'laporan',
            'breadcrumb' => 'laporan',
            'orders' => Order::get(),
        ]);
    }

    /**
     * Display the daily sales report.
     *
     * Shows a summary of daily transactions, including debt (Piutang) and sales data.
     * Adjusts payment values to exclude overpayment (kembalian) for non-debt transactions.
     *
     * @param \Illuminate\Http\Request $request
     *    The HTTP request containing any additional filters or parameters.
     *
     * @return \Illuminate\View\View
     */
    public function daily(Request $request)
    {
        $transactions = Transaction::leftJoin('piutangs', 'transactions.kode_inv', '=', 'piutangs.kode_inv')->select('transactions.*', 'piutangs.sisa_bayar')->get();

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
