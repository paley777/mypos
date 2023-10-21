<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Http\Requests\StoreStokBarangRequest;
use App\Http\Requests\UpdateStokBarangRequest;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.arusbarang.stokbarang.index', [
            'active' => 'arusbarang',
            'breadcrumb' => 'stokbarang',
            'stokbarangs' => StokBarang::orderBy('nama_barang', 'desc')
                ->filter(request(['search']))
                ->get(),
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
    public function store(StoreStokBarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StokBarang $stok_barang)
    {
        return view('dashboard.arusbarang.stokbarang.edit', [
            'active' => 'arusbarang',
            'breadcrumb' => 'edit_stokbarang',
            'stokbarang' => $stok_barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokBarangRequest $request, StokBarang $stok_barang)
    {
        $validated = $request->validated();
        StokBarang::where('id', $stok_barang['id'])->update([
          
            'stok' => $validated['stok'],
        ]);
        return redirect('/dashboard/stok-barang')->with('success', 'Stok telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StokBarang $stokBarang)
    {
        //
    }
}
