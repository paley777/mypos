<?php

/**
 * BarangMasukController
 *
 * This controller handles CRUD operations and additional functionality for the "BarangMasuk" model.
 * It manages the addition, update, deletion, and payment status of incoming goods and ensures that stock
 * levels in the "StokBarang" model are kept in sync with the operations.
 */

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\StokBarang;
use App\Models\Supplier;
use App\Http\Requests\StoreBarangMasukRequest;
use App\Http\Requests\UpdateBarangMasukRequest;
use Illuminate\Support\Arr;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Shows a list of "BarangMasuk" resources, optionally filtered by a search query.
     *
     * @return \Illuminate\View\View
     *    Displays the list of incoming goods in the dashboard.
     */
    public function index()
    {
        return view('dashboard.arusbarang.barangmasuk.index', [
            'active' => 'arusbarang',
            'breadcrumb' => 'barangmasuk',
            'barangmasuks' => BarangMasuk::orderBy('nama_barang', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Displays a form for adding a new incoming goods record.
     *
     * @return \Illuminate\View\View
     *    Provides a form preloaded with suppliers and barang for selection.
     */
    public function create()
    {
        return view('dashboard.arusbarang.barangmasuk.create', [
            'active' => 'arusbarang',
            'breadcrumb' => 'create_barangmasuk',
            'suppliers' => Supplier::get(),
            'barangs' => Barang::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Handles the submission of the creation form, validates and processes input, updates stock,
     * and stores the new incoming goods record in the database.
     *
     * @param \App\Http\Requests\StoreBarangMasukRequest $request
     *    Validated request containing data for the new "BarangMasuk".
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the barang masuk dashboard with a success message.
     */
    public function store(StoreBarangMasukRequest $request)
    {
        $hargabelisatuan = intval(str_replace([','], '', $request->harga_beli_satuan));
        $hargabelitotal = intval(str_replace([','], '', $request->harga_beli_total));

        $validated = $request->validated();
        $barang = Barang::where('nama_barang', $validated['nama_barang'])->first();

        BarangMasuk::create([
            'nama_penerima' => $validated['nama_penerima'],
            'nama_supplier' => $validated['nama_supplier'],
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $barang->satuan,
            'jumlah_beli' => $validated['jumlah_beli'],
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'harga_beli_satuan' => $hargabelisatuan,
            'harga_beli_total' => $hargabelitotal,
        ]);

        $stokbarang = StokBarang::where('nama_barang', $validated['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->tambahStok($validated['jumlah_beli']);
        }

        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk beserta stok telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Displays a form for editing an existing incoming goods record.
     *
     * @param \App\Models\BarangMasuk $barang_masuk
     *    The incoming goods record to edit.
     *
     * @return \Illuminate\View\View
     *    Returns a view preloaded with data for editing.
     */
    public function edit(BarangMasuk $barang_masuk)
    {
        return view('dashboard.arusbarang.barangmasuk.edit', [
            'active' => 'arusbarang',
            'breadcrumb' => 'edit_barangmasuk',
            'barangmasuk' => $barang_masuk,
            'suppliers' => Supplier::get(),
            'barangs' => Barang::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Handles form submissions for updating an incoming goods record, adjusts stock levels as necessary,
     * and updates the record in the database.
     *
     * @param \App\Http\Requests\UpdateBarangMasukRequest $request
     *    Validated request containing updated data for the "BarangMasuk".
     * @param \App\Models\BarangMasuk $barang_masuk
     *    The record to update.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the barang masuk dashboard with a success message.
     */
    public function update(UpdateBarangMasukRequest $request, BarangMasuk $barang_masuk)
    {
        $validated = $request->validated();
        $barang = Barang::where('nama_barang', $validated['nama_barang'])->first();

        BarangMasuk::where('id', $barang_masuk['id'])->update([
            'nama_penerima' => $validated['nama_penerima'],
            'nama_supplier' => $validated['nama_supplier'],
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $barang->satuan,
            'jumlah_beli' => $validated['jumlah_beli'],
            'harga_beli_satuan' => $validated['harga_beli_satuan'],
            'harga_beli_total' => $validated['harga_beli_total'],
            'keterangan' => $validated['keterangan'],
            'status' => $validated['status'],
        ]);

        $stokbarang = StokBarang::where('nama_barang', $validated['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->kurangStok($barang_masuk['jumlah_beli']);
            $stokbarang->tambahStok($validated['jumlah_beli']);
        }

        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk beserta stok telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes an incoming goods record and adjusts stock levels accordingly.
     *
     * @param \App\Models\BarangMasuk $barang_masuk
     *    The incoming goods record to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the barang masuk dashboard with a success message.
     */
    public function destroy(BarangMasuk $barang_masuk)
    {
        $stokbarang = StokBarang::where('nama_barang', $barang_masuk['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->kurangStok($barang_masuk['jumlah_beli']);
        }

        BarangMasuk::destroy($barang_masuk->id);

        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk telah dihapus!');
    }

    /**
     * Mark the specified resource as paid.
     *
     * Updates the payment status of an incoming goods record to "LUNAS".
     *
     * @param \App\Models\BarangMasuk $BarangMasuk
     *    The incoming goods record to mark as paid.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the barang masuk dashboard with a success message.
     */
    public function lunas(BarangMasuk $BarangMasuk)
    {
        BarangMasuk::where('id', $BarangMasuk->id)->update([
            'status' => 'LUNAS',
        ]);

        return redirect('/dashboard/barang-masuk')->with('success', 'Barang telah dilunaskan!');
    }
}
