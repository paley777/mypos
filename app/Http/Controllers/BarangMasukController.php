<?php

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
        $tambah = $validated['jumlah_beli'];
        $stokbarang = StokBarang::where('nama_barang', $validated['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->tambahStok($tambah);
        }
        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk beserta stok telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
        ]);
        $kurang = $barang_masuk['jumlah_beli'];
        $tambah = $validated['jumlah_beli'];
        $stokbarang = StokBarang::where('nama_barang', $validated['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->kurangStok($kurang);
            $stokbarang->tambahStok($tambah);
        }
        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk beserta stok telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barang_masuk)
    {
        $kurang = $barang_masuk['jumlah_beli'];
        $stokbarang = StokBarang::where('nama_barang', $barang_masuk['nama_barang'])->first();
        if ($stokbarang) {
            $stokbarang->kurangStok($kurang);
        }
        BarangMasuk::destroy($barang_masuk->id);
        return redirect('/dashboard/barang-masuk')->with('success', 'Barang Masuk telah dihapus!');
    }
}
