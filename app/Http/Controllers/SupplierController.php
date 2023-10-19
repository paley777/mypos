<?php

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
     */
    public function store(StoreSupplierRequest $request)
    {
        $validated = $request->validated();
        Supplier::create($validated);

        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     */
    public function update(UpdateSupplierRequest $request, Supplier $regis_supplier)
    {
        $validated = $request->validated();
        Supplier::where('id', $regis_supplier['id'])->update($validated);
        BarangMasuk::where('nama_supplier', $regis_supplier->nama)->update([
            'nama_supplier' => $validated['nama'],
        ]);
        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $regis_supplier)
    {
        Supplier::destroy($regis_supplier->id);
        return redirect('/dashboard/regis-supplier')->with('success', 'Supplier telah dihapus!');
    }
}
