<?php

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
     * Display a listing of the resource.
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
     * Display a listing of the resource.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Retrieve all orders associated with the transaction
        $orders = Order::where('kode_inv', $transaction->kode_inv)->get();

        // Loop through each order to return items back to stock
        foreach ($orders as $order) {
            // Get the stock item
            $stokBarang = StokBarang::where('nama_barang', $order->nama_barang)->first();
            if ($stokBarang) {
                // Add back the quantity to the stock
                $stokBarang->tambahStok($order->qty);
            }
        }

        // Delete the orders
        Order::where('kode_inv', $transaction->kode_inv)->delete();

        // Delete the transaction
        Transaction::destroy($transaction->id);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dihapus!');
    }
    /**
     * Remove the specified resource from storage.
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

    // Edit Route
    public function edit(Transaction $transaction)
    {
        return view('dashboard.invoice.edit', [
            'active' => 'invoice',
            'breadcrumb' => 'edit_invoice',
            'transaction' => $transaction,
            'pelanggan' => Pelanggan::where('nama', $transaction->nama_pelanggan)->first(),
            'orders' => Order::where('kode_inv', $transaction->kode_inv)->get(),
            'stokbarangs' => StokBarang::get(),
            'allPelanggan' => Pelanggan::all(), // Fetch all customers
        ]);
    }

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

        // Retrieve all orders associated with the transaction
        $orders = Order::where('kode_inv', $transaction->kode_inv)->get();

        // Loop through each order to return items back to stock
        foreach ($orders as $order) {
            // Get the stock item
            $stokBarang = StokBarang::where('nama_barang', $order->nama_barang)->first();
            if ($stokBarang) {
                // Add back the quantity to the stock
                $stokBarang->tambahStok($order->qty);
            }
        }

        // Delete the old orders
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

        // Create new orders
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

            $kurang = $validated['qty'][$key];
            $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
            if ($stokbarang) {
                $stokbarang->kurangStok($kurang);
            }

            BarangKeluar::create([
                'kode_inv' => $transaction->kode_inv,
                'nama_barang' => $nama_barang,
                'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                'jumlah_keluar' => $validated['qty'][$key],
            ]);
        }

        if ($validated['status'] == 'HUTANG') {
            Piutang::create([
                'kode_inv' => $transaction->kode_inv,
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'sisa_bayar' => $kembalian,
                'harga_asli' => $total,
                'jatuh_tempo' => $validated['jatuh_tempo']
            ]);
        } elseif ($validated['status'] == 'LUNAS') {
            // Check if the Piutang record exists and delete it
            $piutang = Piutang::where('kode_inv', $transaction->kode_inv)->first();
            if ($piutang) {
                $piutang->delete();
            }
        }


        $transaction->update(['profit' => $profit]);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah diperbarui!');
    }
}
