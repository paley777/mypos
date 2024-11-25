<?php

/**
 * SupplierController
 *
 * This controller handles the CRUD operations for suppliers (Supplier model).
 * It allows users to list, create, edit, update, and delete supplier records.
 * Updates to supplier names also reflect in related "BarangMasuk" records.
 */

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Support\Arr;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Shows a list of all suppliers, optionally filtered by search criteria.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.regis.regissupplier.index', [
            'active' => 'registrasi',
            'breadcrumb' => 'regissupplier',
            'suppliers' => Supplier::orderBy('nama', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Displays a form for adding a new supplier.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.regis.regissupplier.create', [
            'active' => 'registrasi',
            'breadcrumb' => 'create_regissupplier',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Handles the submission of the creation form and saves a new supplier record.
     *
     * @param \App\Http\Requests\StoreSupplierRequest $request
     *    Validated request containing supplier data.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the supplier list with a success message.
     */
    public function store(StoreSupplierRequest $request)
    {
        $validated = $request->validated();
        Supplier::create($validated);

        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * Currently not implemented.
     *
     * @param \App\Models\Supplier $supplier
     */
    public function show(Supplier $supplier)
    {
        // Reserved for future use
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Displays a form to edit an existing supplier record.
     *
     * @param \App\Models\Supplier $regis_supplier
     *    The supplier record to edit.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Supplier $regis_supplier)
    {
        return view('dashboard.regis.regissupplier.edit', [
            'active' => 'registrasi',
            'breadcrumb' => 'edit_regissupplier',
            'supplier' => $regis_supplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Updates an existing supplier record and reflects the changes in related "BarangMasuk" records.
     *
     * @param \App\Http\Requests\UpdateSupplierRequest $request
     *    Validated request containing updated supplier data.
     * @param \App\Models\Supplier $regis_supplier
     *    The supplier record to update.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the supplier list with a success message.
     */
    public function update(UpdateSupplierRequest $request, Supplier $regis_supplier)
    {
        $validated = $request->validated();
        Supplier::where('id', $regis_supplier['id'])->update($validated);

        // Update supplier name in related "BarangMasuk" records
        BarangMasuk::where('nama_supplier', $regis_supplier->nama)->update([
            'nama_supplier' => $validated['nama'],
        ]);

        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes a supplier record from the database.
     *
     * @param \App\Models\Supplier $regis_supplier
     *    The supplier record to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the supplier list with a success message.
     */
    public function destroy(Supplier $regis_supplier)
    {
        Supplier::destroy($regis_supplier->id);

        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah dihapus!');
    }
}
