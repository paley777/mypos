<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\StokBarang;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Piutang;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kasir.index', [
            'active' => 'kasir',
            'breadcrumb' => 'kasir',
            'pelanggans' => Pelanggan::get(),
            'stokbarangs' => StokBarang::get(),
            'kode_inv' => IdGenerator::generate(['table' => 'transactions', 'field' => 'kode_inv', 'length' => 10, 'prefix' => 'INV-']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $profit = 0;
        $bayar = intval(str_replace([','], '', $request->bayar));
        $total = intval(str_replace([','], '', $request->total));
        $kembalian = intval(str_replace([','], '', $request->kembalian));

        $validated = $request->validated();

        // Iterasi data barang yang dipesan
        $nama_barang = $request->input('nama_barang');
        $harga_jual = $request->input('harga_jual');
        $qty = $request->input('qty');
        $disc_perc = $request->input('disc_perc');
        $disc_rp = $request->input('disc_rp');
        $subtotal = $request->input('subtotal');

        foreach ($nama_barang as $key => $nama_barang) {
            $harga_jual[$key] = intval(str_replace([','], '', $harga_jual[$key])); // Convert harga_jual to integer
            $subtotal[$key] = intval(str_replace([','], '', $subtotal[$key])); // Convert subtotal to integer

            Order::create([
                'kode_inv' => $validated['kode_inv'],
                'nama_barang' => $nama_barang,
                'harga_jual' => $harga_jual[$key],
                'qty' => $qty[$key],
                'disc_perc' => $disc_perc[$key],
                'disc_rp' => $disc_rp[$key],
                'subtotal' => $subtotal[$key],
            ]);
            $modal = Barang::where('nama_barang', $nama_barang)->first()->modal;
            $profit += $subtotal[$key] - $modal * $qty[$key];

            $kurang = $qty[$key];
            $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
            if ($stokbarang) {
                $stokbarang->kurangStok($kurang);
            }
            BarangKeluar::create([
                'kode_inv' => $validated['kode_inv'],
                'nama_barang' => $nama_barang,
                'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                'jumlah_keluar' => $qty[$key],
            ]);
        }
        Transaction::create([
            'kode_inv' => $validated['kode_inv'],
            'nama_petugas' => $validated['nama_petugas'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'status' => $validated['status'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'keterangan' => $validated['keterangan'],
            'total' => $total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'profit' => $profit,
        ]);

        if ($validated['status'] == 'HUTANG') {
            Piutang::create([
                'kode_inv' => $validated['kode_inv'],
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'sisa_bayar' => $kembalian,
                'harga_asli' => $total,
                'jatuh_tempo' => $validated['jatuh_tempo']
            ]);
        }



        return redirect()->back()->with('success', 'Transaksi sukses, Silakan menuju fitur Invoice untuk mencetak!');
    }

    public function rombak(StoreTransactionRequest $request)
    {
        $profit = 0;
        $kode_inv = $request->kode_inv;
        $bayar = intval(str_replace([','], '', $request->bayar));
        $total = intval(str_replace([','], '', $request->total));
        $kembalian = intval(str_replace([','], '', $request->kembalian));

        $validated = $request->validated();

        // Delete the existing entries
        Order::where('kode_inv', $kode_inv)->delete();
        BarangKeluar::where('kode_inv', $kode_inv)->delete();
        Piutang::where('kode_inv', $kode_inv)->delete();
        Transaction::where('kode_inv', $kode_inv)->delete();

        // Iterasi data barang yang dipesan
        $nama_barang = $request->input('nama_barang');
        $harga_jual = $request->input('harga_jual');
        $qty = $request->input('qty');
        $disc_perc = $request->input('disc_perc');
        $disc_rp = $request->input('disc_rp');
        $subtotal = $request->input('subtotal');

        foreach ($nama_barang as $key => $nama_barang) {
            $harga_jual[$key] = intval(str_replace([','], '', $harga_jual[$key])); // Convert harga_jual to integer
            $subtotal[$key] = intval(str_replace([','], '', $subtotal[$key])); // Convert subtotal to integer

            // Create new order entry with same kode_inv
            Order::create([
                'kode_inv' => $kode_inv,
                'nama_barang' => $nama_barang,
                'harga_jual' => $harga_jual[$key],
                'qty' => $qty[$key],
                'disc_perc' => $disc_perc[$key],
                'disc_rp' => $disc_rp[$key],
                'subtotal' => $subtotal[$key],
            ]);

            // Calculate profit
            $modal = Barang::where('nama_barang', $nama_barang)->first()->modal;
            $profit += $subtotal[$key] - $modal * $qty[$key];

            // Update stock
            $kurang = $qty[$key];
            $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
            if ($stokbarang) {
                $stokbarang->kurangStok($kurang);
            }

            // Create BarangKeluar entry
            BarangKeluar::create([
                'kode_inv' => $kode_inv,
                'nama_barang' => $nama_barang,
                'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                'jumlah_keluar' => $qty[$key],
            ]);
        }



        // Create Transaction entry with the same kode_inv
        Transaction::create([
            'kode_inv' => $kode_inv,
            'nama_petugas' => $validated['nama_petugas'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'status' => $validated['status'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'keterangan' => $validated['keterangan'],
            'total' => $total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'profit' => $profit,
        ]);

        // Handle Piutang if status is 'HUTANG'
        if ($validated['status'] == 'HUTANG') {
            Piutang::where('kode_inv', $kode_inv)->update([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'sisa_bayar' => $kembalian,
                'harga_asli' => $total,
                'jatuh_tempo' => $validated['jatuh_tempo'],
            ]);
        }

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah diperbarui!');
    }

    public function rombak_view($transaction)
    {
        $transaction = Transaction::where('id', $transaction)->first();
        $orders = Order::where('kode_inv', $transaction->kode_inv)->get();
        $pelanggans = Pelanggan::get();
        $stokbarangs = StokBarang::get();


        return view('dashboard.invoice.rombak', [
            'kode_inv' => $transaction->kode_inv,
            'active' => 'kasir',
            'breadcrumb' => 'kasir',
            'transaction' => $transaction,

            'orders' => $orders,
            'pelanggans' => $pelanggans,
            'stokbarangs' => $stokbarangs,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
