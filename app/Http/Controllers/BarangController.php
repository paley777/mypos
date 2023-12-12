<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\StokBarang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Arr;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.regis.regisbarang.index', [
            'active' => 'registrasi',
            'breadcrumb' => 'regisbarang',
            'barangs' => Barang::orderBy('nama_barang', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.regis.regisbarang.create', [
            'active' => 'registrasi',
            'breadcrumb' => 'create_regisbarang',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        $modal = $request->modal;
        $modalclean = intval(str_replace([','], '', $modal));
        $hargajual = $request->harga_jual;
        $hargajualclean = intval(str_replace([','], '', $hargajual));

        $validated = $request->validated();
        Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $validated['satuan'],
            'harga_jual' => $hargajualclean,
            'modal' => $modalclean,
        ]);
        StokBarang::create([
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $validated['satuan'],
            'stok' => 0,
            'harga_jual' => $hargajualclean,
            'modal' => $modalclean,
        ]);

        return redirect('/dashboard/regis-barang')->with('success', 'Barang telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $regis_barang)
    {
        return view('dashboard.regis.regisbarang.edit', [
            'active' => 'registrasi',
            'barang' => $regis_barang,
            'breadcrumb' => 'edit_regisbarang',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $regis_barang)
    {
        $modal = $request->modal;
        $modalclean = intval(str_replace([','], '', $modal));
        $hargajual = $request->harga_jual;
        $hargajualclean = intval(str_replace([','], '', $hargajual));

        $validated = $request->validated();
        Barang::where('id', $regis_barang['id'])->update([
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $validated['satuan'],
            'harga_jual' => $hargajualclean,
            'modal' => $modalclean,
        ]);
        StokBarang::where('nama_barang', $regis_barang->nama_barang)->update([
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $validated['satuan'],
            'harga_jual' => $hargajualclean,
        ]);
        BarangMasuk::where('nama_barang', $regis_barang->nama_barang)->update([
            'nama_barang' => $validated['nama_barang'],
        ]);
        return redirect('/dashboard/regis-barang')->with('success', 'Barang telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $regis_barang)
    {
        StokBarang::where('nama_barang', $regis_barang->nama_barang)->delete();
        BarangMasuk::where('nama_barang', $regis_barang->nama_barang)->delete();
        Barang::destroy($regis_barang->id);
        return redirect('/dashboard/regis-barang')->with('success', 'Barang telah dihapus!');
    }
}
