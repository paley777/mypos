<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\StokBarang;
use App\Models\BarangKeluar;
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
        $validated = $request->validated();
        Transaction::create([
            'kode_inv' => $validated['kode_inv'],
            'nama_petugas' => $validated['nama_petugas'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'status' => $validated['status'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'keterangan' => $validated['keterangan'],
            'total' => $validated['total'],
        ]);

        // Iterasi data barang yang dipesan
        $nama_barang = $request->input('nama_barang');
        $harga_jual = $request->input('harga_jual');
        $qty = $request->input('qty');
        $disc_perc = $request->input('disc_perc');
        $disc_rp = $request->input('disc_rp');
        $subtotal = $request->input('subtotal');

        foreach ($nama_barang as $key => $nama_barang) {
            Order::create([
                'kode_inv' => $validated['kode_inv'],
                'nama_barang' => $nama_barang,
                'harga_jual' => $harga_jual[$key],
                'qty' => $qty[$key],
                'disc_perc' => $disc_perc[$key],
                'disc_rp' => $disc_rp[$key],
                'subtotal' => $subtotal[$key],
            ]);
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
        return redirect()
            ->back()
            ->with('success', 'Transaksi sukses, Silakan menuju fitur Invoice untuk mencetak!');
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
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
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
