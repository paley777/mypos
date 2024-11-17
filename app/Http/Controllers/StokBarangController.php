<?php

/**
 * StokBarangController
 *
 * This controller manages the inventory of stock items (StokBarang).
 * It handles listing, editing, and updating stock levels in the system.
 */

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Http\Requests\StoreStokBarangRequest;
use App\Http\Requests\UpdateStokBarangRequest;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Shows a list of all stock items, optionally filtered by search criteria.
     *
     * @return \Illuminate\View\View
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
     *
     * Currently not implemented.
     */
    public function create()
    {
        // Reserved for future use
    }

    /**
     * Store a newly created resource in storage.
     *
     * Currently not implemented.
     *
     * @param \App\Http\Requests\StoreStokBarangRequest $request
     */
    public function store(StoreStokBarangRequest $request)
    {
        // Reserved for future use
    }

    /**
     * Display the specified resource.
     *
     * Currently not implemented.
     *
     * @param \App\Models\StokBarang $stokBarang
     */
    public function show(StokBarang $stokBarang)
    {
        // Reserved for future use
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Displays a form to edit an existing stock item.
     *
     * @param \App\Models\StokBarang $stok_barang
     *    The stock item to edit.
     *
     * @return \Illuminate\View\View
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
     *
     * Updates the stock level of a specific stock item.
     *
     * @param \App\Http\Requests\UpdateStokBarangRequest $request
     *    The request containing validated stock data.
     * @param \App\Models\StokBarang $stok_barang
     *    The stock item to update.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the stock list with a success message.
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
     *
     * Currently not implemented.
     *
     * @param \App\Models\StokBarang $stokBarang
     */
    public function destroy(StokBarang $stokBarang)
    {
        // Reserved for future use
    }
}
