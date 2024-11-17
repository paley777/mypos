<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Http\Requests\StoreBarangKeluarRequest;
use App\Http\Requests\UpdateBarangKeluarRequest;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method is responsible for retrieving and displaying a list of "BarangKeluar" resources.
     * It fetches the data from the database, optionally applies filters based on user input,
     * and passes the data to the appropriate view for rendering.
     *
     * @return \Illuminate\View\View
     *    Returns a view containing the list of "BarangKeluar" items to be displayed.
     *
     * Functionality:
     * 1. Sets up the view with required variables:
     *    - 'active' => Indicates the currently active menu or tab, set to 'arusbarang'.
     *    - 'breadcrumb' => Used for breadcrumb navigation, set to 'barangkeluar'.
     *    - 'barangkeluars' => Retrieves a sorted and optionally filtered list of "BarangKeluar" items:
     *      - The items are sorted in descending order by 'kode_inv'.
     *      - Applies a filter based on the 'search' query parameter, if provided.
     * 2. Passes these variables to the view located at 'dashboard.arusbarang.barangkeluar.index'.
     *
     * This ensures that the "BarangKeluar" resources are presented to the user with proper context
     * and functionality for searching and navigating through the data.
     */
    public function index()
    {
        return view('dashboard.arusbarang.barangkeluar.index', [
            'active' => 'arusbarang',
            'breadcrumb' => 'barangkeluar',
            'barangkeluars' => BarangKeluar::orderBy('kode_inv', 'desc')
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
    public function store(StoreBarangKeluarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangKeluarRequest $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }
}
