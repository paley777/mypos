<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use Illuminate\Support\Arr;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.regis.regispelanggan.index', [
            'active' => 'registrasi',
            'breadcrumb' => 'regispelanggan',
            'pelanggans' => Pelanggan::orderBy('nama', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.regis.regispelanggan.create', [
            'active' => 'registrasi',
            'breadcrumb' => 'create_regispelanggan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        $validated = $request->validated();
        Pelanggan::create($validated);

        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $regis_pelanggan)
    {
        return view('dashboard.regis.regispelanggan.edit', [
            'active' => 'registrasi',
            'breadcrumb' => 'edit_regispelanggan',
            'pelanggan' => $regis_pelanggan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $regis_pelanggan)
    {
        $validated = $request->validated();
        Pelanggan::where('id', $regis_pelanggan['id'])->update($validated);

        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $regis_pelanggan)
    {
        Pelanggan::destroy($regis_pelanggan->id);
        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah dihapus!');
    }
}
