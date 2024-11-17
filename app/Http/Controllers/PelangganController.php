<?php

/**
 * PelangganController
 *
 * This controller manages the CRUD operations for the "Pelanggan" model (Customers).
 * It handles listing, creating, editing, updating, and deleting customer records.
 */

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use Illuminate\Support\Arr;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Shows a list of customers (Pelanggan) with an optional search filter.
     *
     * @return \Illuminate\View\View
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
     *
     * Displays a form for adding a new customer.
     *
     * @return \Illuminate\View\View
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
     *
     * Handles the creation of a new customer after form submission.
     *
     * @param \App\Http\Requests\StorePelangganRequest $request
     *    Validated request containing customer data.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the customer list with a success message.
     */
    public function store(StorePelangganRequest $request)
    {
        $validated = $request->validated();
        Pelanggan::create($validated);

        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * Currently not implemented.
     *
     * @param \App\Models\Pelanggan $pelanggan
     */
    public function show(Pelanggan $pelanggan)
    {
        // Reserved for future use
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Displays a form to edit an existing customer record.
     *
     * @param \App\Models\Pelanggan $regis_pelanggan
     *    The customer to edit.
     *
     * @return \Illuminate\View\View
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
     *
     * Updates an existing customer record with new data from the form submission.
     *
     * @param \App\Http\Requests\UpdatePelangganRequest $request
     *    Validated request containing updated customer data.
     * @param \App\Models\Pelanggan $regis_pelanggan
     *    The customer record to update.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the customer list with a success message.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $regis_pelanggan)
    {
        $validated = $request->validated();
        Pelanggan::where('id', $regis_pelanggan['id'])->update($validated);

        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes a customer record from the database.
     *
     * @param \App\Models\Pelanggan $regis_pelanggan
     *    The customer record to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the customer list with a success message.
     */
    public function destroy(Pelanggan $regis_pelanggan)
    {
        Pelanggan::destroy($regis_pelanggan->id);
        return redirect('/dashboard/regis-pelanggan')->with('success', 'Pelanggan telah dihapus!');
    }
}
