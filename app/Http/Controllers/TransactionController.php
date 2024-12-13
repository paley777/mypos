<?php

/**
 * TransactionController
 *
 * This controller handles the management of transactions, including creating, updating, and remaking transactions.
 * It ensures inventory, orders, and financial data are updated consistently during each transaction operation.
 */

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
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display the transaction dashboard.
     *
     * Shows the cashier's interface for creating transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        DB::beginTransaction();

        try {
            $attempts = 0; // Counter untuk menghitung berapa kali sistem mencoba
            $kode_inv = '';

            // Loop untuk mencoba hingga kode unik ditemukan
            do {
                $kode_inv = IdGenerator::generate(['table' => 'transactions', 'field' => 'kode_inv', 'length' => 10, 'prefix' => 'INV-']);
                $attempts++; // Increment jumlah percobaan

                // Cek apakah kode_inv sudah ada di database
            } while (DB::table('transactions')->where('kode_inv', $kode_inv)->exists());

            // Setelah menemukan kode yang unik, lanjutkan dengan logika lainnya
            return view('dashboard.kasir.index', [
                'active' => 'kasir',
                'breadcrumb' => 'kasir',
                'pelanggans' => Pelanggan::get(),
                'stokbarangs' => StokBarang::get(),
                'kode_inv' => $kode_inv,
                'attempts' => $attempts, // Kirimkan jumlah percobaan ke view
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Log atau tangani exception
            throw $e;
        }
    }

    /**
     * Store a newly created transaction.
     *
     * Processes a new transaction, updating orders, stock, and financial records.
     *
     * @param \App\Http\Requests\StoreTransactionRequest $request
     *    The validated request containing transaction details.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects back with a success message.
     */
    public function store(StoreTransactionRequest $request)
    {
        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Ambil kode_inv dari request (sudah di-generate di index)
            $kode_inv = $request->input('kode_inv');

            // Cek apakah kode_inv sudah ada di database
            $existingTransaction = Transaction::where('kode_inv', $kode_inv)->first();
            if ($existingTransaction) {
                // Jika kode_inv sudah ada, lemparkan pengecualian
                throw new \Exception('Kode invoice sudah ada, silakan coba lagi.');
            }

            // Jika kode_inv unik, lanjutkan dengan logika penyimpanan transaksi
            $profit = 0;
            $bayar = intval(str_replace([','], '', $request->bayar));
            $total = intval(str_replace([','], '', $request->total));
            $kembalian = intval(str_replace([','], '', $request->kembalian));

            $validated = $request->validated();

            // Iterasi setiap barang yang dibeli
            $nama_barang = $request->input('nama_barang');
            $harga_jual = $request->input('harga_jual');
            $qty = $request->input('qty');
            $disc_perc = $request->input('disc_perc');
            $disc_rp = $request->input('disc_rp');
            $subtotal = $request->input('subtotal');

            foreach ($nama_barang as $key => $nama_barang) {
                $harga_jual[$key] = intval(str_replace([','], '', $harga_jual[$key]));
                $subtotal[$key] = intval(str_replace([','], '', $subtotal[$key]));

                Order::create([
                    'kode_inv' => $kode_inv,
                    'nama_barang' => $nama_barang,
                    'harga_jual' => $harga_jual[$key],
                    'qty' => $qty[$key],
                    'disc_perc' => $disc_perc[$key],
                    'disc_rp' => $disc_rp[$key],
                    'subtotal' => $subtotal[$key],
                ]);

                $modal = Barang::where('nama_barang', $nama_barang)->first()->modal;
                $profit += $subtotal[$key] - $modal * $qty[$key];

                // Update stok barang
                $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
                if ($stokbarang) {
                    $stokbarang->kurangStok($qty[$key]);
                }

                // Catat barang keluar
                BarangKeluar::create([
                    'kode_inv' => $kode_inv,
                    'nama_barang' => $nama_barang,
                    'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                    'jumlah_keluar' => $qty[$key],
                ]);
            }
            // Handle hutang (Piutang) jika status adalah HUTANG
            if ($validated['status'] == 'HUTANG') {
                Piutang::create([
                    'kode_inv' => $kode_inv,
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'sisa_bayar' => $kembalian,
                    'harga_asli' => $total,
                    'jatuh_tempo' => $validated['jatuh_tempo'],
                ]);
            }
            // Create the transaction
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

            DB::commit(); // Commit transaksi

            return redirect()->back()->with('success', 'Transaksi sukses, Silakan menuju fitur Invoice untuk mencetak!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            // Menangani error, bisa log error atau menampilkan pesan kepada pengguna
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Modify an existing transaction.
     *
     * Deletes the current transaction record and creates a new one with the updated details.
     *
     * @param \App\Http\Requests\StoreTransactionRequest $request
     *    The validated request containing updated transaction details.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the invoice dashboard with a success message.
     */
    public function rombak(StoreTransactionRequest $request)
    {
        $profit = 0;
        $kode_inv = $request->kode_inv;
        $bayar = intval(str_replace([','], '', $request->bayar));
        $total = intval(str_replace([','], '', $request->total));
        $kembalian = intval(str_replace([','], '', $request->kembalian));

        $validated = $request->validated();

        // Delete existing records
        Order::where('kode_inv', $kode_inv)->delete();
        BarangKeluar::where('kode_inv', $kode_inv)->delete();
        Piutang::where('kode_inv', $kode_inv)->delete();
        Transaction::where('kode_inv', $kode_inv)->delete();

        // Process the new transaction details
        $nama_barang = $request->input('nama_barang');
        $harga_jual = $request->input('harga_jual');
        $qty = $request->input('qty');
        $disc_perc = $request->input('disc_perc');
        $disc_rp = $request->input('disc_rp');
        $subtotal = $request->input('subtotal');

        foreach ($nama_barang as $key => $nama_barang) {
            $harga_jual[$key] = intval(str_replace([','], '', $harga_jual[$key]));
            $subtotal[$key] = intval(str_replace([','], '', $subtotal[$key]));

            Order::create([
                'kode_inv' => $kode_inv,
                'nama_barang' => $nama_barang,
                'harga_jual' => $harga_jual[$key],
                'qty' => $qty[$key],
                'disc_perc' => $disc_perc[$key],
                'disc_rp' => $disc_rp[$key],
                'subtotal' => $subtotal[$key],
            ]);

            $modal = Barang::where('nama_barang', $nama_barang)->first()->modal;
            $profit += $subtotal[$key] - $modal * $qty[$key];

            $stokbarang = StokBarang::where('nama_barang', $nama_barang)->first();
            if ($stokbarang) {
                $stokbarang->kurangStok($qty[$key]);
            }

            BarangKeluar::create([
                'kode_inv' => $kode_inv,
                'nama_barang' => $nama_barang,
                'satuan' => StokBarang::where('nama_barang', $nama_barang)->first()->satuan,
                'jumlah_keluar' => $qty[$key],
            ]);
        }

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

        // Handle debts (HUTANG)
        if ($validated['status'] == 'HUTANG') {
            Piutang::create([
                'kode_inv' => $kode_inv,
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'sisa_bayar' => $kembalian,
                'harga_asli' => $total,
                'jatuh_tempo' => $validated['jatuh_tempo'],
            ]);
        }

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah diperbarui!');
    }

    /**
     * Show the view to modify a transaction.
     *
     * Displays the existing transaction details for editing.
     *
     * @param int $transaction
     *    The ID of the transaction to modify.
     *
     * @return \Illuminate\View\View
     */
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
     * Update the specified transaction.
     *
     * @param \App\Http\Requests\UpdateTransactionRequest $request
     * @param \App\Models\Transaction $transaction
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        // Reserved for future use
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        // Reserved for future use
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Reserved for future use
    }
}
