<?php

/**
 * InvoiceController
 * 
 * This controller manages the creation, deletion, updating, and printing of invoices.
 * It ensures that stock levels and transaction records are updated in sync with invoice operations.
 */

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pelanggan;
use App\Models\Order;
use App\Models\StokBarang;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Piutang;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices.
     * 
     * Shows a list of all transactions (invoices) in the system.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.invoice.index', [
            'active' => 'invoice',
            'breadcrumb' => 'invoice',
            'transactions' => Transaction::get(),
        ]);
    }

    /**
     * Print an invoice.
     * 
     * Displays a detailed view of a single invoice, including related customer and order data.
     * 
     * @param \App\Models\Transaction $transaction
     *    The transaction (invoice) to print.
     * 
     * @return \Illuminate\View\View
     */
    public function print(Transaction $transaction)
    {
        return view('dashboard.invoice.invoice', [
            'active' => 'invoice',
            'breadcrumb' => 'invoice',
            'transaction' => $transaction,
            'pelanggan' => Pelanggan::where('nama', $transaction->nama_pelanggan)->first(),
            'orders' => Order::where('kode_inv', $transaction->kode_inv)->get(),
        ]);
    }

    /**
     * Delete an invoice.
     * 
     * Removes an invoice and associated orders from the database, returning stock items to inventory.
     * 
     * @param \App\Models\Transaction $transaction
     *    The transaction (invoice) to delete.
     * 
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the invoice dashboard with a success message.
     */
    public function destroy(Transaction $transaction)
    {
        // Retrieve all orders associated with the transaction
        $orders = Order::where('kode_inv', $transaction->kode_inv)->get();

        // Return items back to stock
        foreach ($orders as $order) {
            $stokBarang = StokBarang::where('nama_barang', $order->nama_barang)->first();
            if ($stokBarang) {
                $stokBarang->tambahStok($order->qty);
            }
        }

        // Delete orders and transaction
        Order::where('kode_inv', $transaction->kode_inv)->delete();
        Transaction::destroy($transaction->id);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dihapus!');
    }

    /**
     * Mark an invoice as paid (LUNAS).
     * 
     * Updates the payment status of an invoice to "LUNAS".
     * 
     * @param \App\Models\Transaction $transaction
     *    The transaction (invoice) to mark as paid.
     * 
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the invoice dashboard with a success message.
     */
    public function lunas(Transaction $transaction)
    {
        Transaction::where('kode_inv', $transaction->kode_inv)->update([
            'status' => 'LUNAS',
            'kembalian' => 0,
            'bayar' => $transaction->total,
        ]);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dilunaskan!');
    }

    /**
     * Update an invoice.
     * 
     * Modifies an existing invoice, updating associated orders, stocks, and financial data.
     * 
     * @param \Illuminate\Http\Request $request
     *    The HTTP request containing the updated invoice data.
     * @param \App\Models\Transaction $transaction
     *    The transaction (invoice) to update.
     * 
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the invoice dashboard with a success message.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $bayar = intval(str_replace([','], '', $request->bayar));
        $total = intval(str_replace([','], '', $request->total));
        $kembalian = intval(str_replace([','], '', $request->kembalian));

        $validated = $request->validate([
            'status' => 'required|string|max:255',
            'jatuh_tempo' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'nama_pelanggan' => 'required|string',
            'nama_barang' => 'required|array',
            'harga_jual' => 'required|array',
            'qty' => 'required|array',
            'disc_perc' => 'required|array',
            'disc_rp' => 'required|array',
            'subtotal' => 'required|array',
        ]);

        // Restore stock from old orders
        $orders = Order::where('kode_inv', $transaction->kode_inv)->get();
        foreach ($orders as $order) {
            $stokBarang = StokBarang::where('nama_barang', $order->nama_barang)->first();
            if ($stokBarang) {
                $stokBarang->tambahStok($order->qty);
            }
        }

        // Delete old orders and related data
        Order::where('kode_inv', $transaction->kode_inv)->delete();
        BarangKeluar::where('kode_inv', $transaction->kode_inv)->delete();

        // Update the transaction
        $transaction->update([
            'status' => $validated['status'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'keterangan' => $validated['keterangan'],
            'total' => $total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
        ]);

        // Recreate orders and update stock
        $profit = 0;
        foreach ($validated['nama_barang'] as $key => $nama_barang) {
            $harga_jual = intval(str_replace([','], '', $validated['harga_jual'][$key]));
            $subtotal = intval(str_replace([','], '', $validated['subtotal'][$key]));

            Order::create([
                'kode_inv' => $transaction->kode_inv,
                'nama_barang' => $nama_barang,
                'harga_jual' => $harga_jual,
                'qty' => $validated['qty'][$key],
                'disc_perc' => $validated['disc_perc'][$key],
                'disc_rp' => $validated['disc_rp'][$key],
                'subtotal' => $subtotal,
            ]);

            $modal = Barang::where('nama_barang', $nama_barang)->first()->modal;
            $profit += $subtotal - $modal * $validated['qty'][$key];

            $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
            if ($stokbarang) {
                $stokbarang->kurangStok($validated['qty'][$key]);
            }

            BarangKeluar::create([
                'kode_inv' => $transaction->kode_inv,
                'nama_barang' => $nama_barang,
                'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                'jumlah_keluar' => $validated['qty'][$key],
            ]);
        }

        // Handle debt (HUTANG) and payment status
        if ($validated['status'] == 'HUTANG') {
            Piutang::create([
                'kode_inv' => $transaction->kode_inv,
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'sisa_bayar' => $kembalian,
                'harga_asli' => $total,
                'jatuh_tempo' => $validated['jatuh_tempo'],
            ]);
        } elseif ($validated['status'] == 'LUNAS') {
            $piutang = Piutang::where('kode_inv', $transaction->kode_inv)->first();
            if ($piutang) {
                $piutang->delete();
            }
        }

        // Update profit
        $transaction->update(['profit' => $profit]);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah diperbarui!');
    }
}
