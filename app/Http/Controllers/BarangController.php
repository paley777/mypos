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
     *
     * This method is responsible for retrieving and displaying a list of "Barang" resources.
     * It fetches the data from the database, optionally applying filters based on user input,
     * and passes the data to the appropriate view for rendering.
     *
     * @return \Illuminate\View\View
     *    Returns a view containing the list of "Barang" items to be displayed.
     *
     * Functionality:
     * 1. Sets up the view with required variables:
     *    - 'active' => Indicates the currently active menu or tab, set to 'registrasi'.
     *    - 'breadcrumb' => Used for breadcrumb navigation, set to 'regisbarang'.
     *    - 'barangs' => Retrieves a sorted and optionally filtered list of "Barang" items.
     *      - The items are sorted in descending order by 'nama_barang'.
     *      - Applies a filter based on the 'search' query parameter, if provided.
     * 2. Passes the variables to the view located at 'dashboard.regis.regisbarang.index'.
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
     *
     * This method is responsible for displaying a form that allows the user to create a new "Barang" resource.
     * The form is rendered using the appropriate view, which is customized with relevant context data.
     *
     * @return \Illuminate\View\View
     *    Returns a view containing the form for creating a new "Barang" resource.
     *
     * Functionality:
     * 1. Sets up the view with required variables:
     *    - 'active' => Indicates the currently active menu or tab, set to 'registrasi'.
     *    - 'breadcrumb' => Used for breadcrumb navigation, set to 'create_regisbarang'.
     * 2. Passes these variables to the view located at 'dashboard.regis.regisbarang.create'.
     *
     * This ensures the form is displayed with proper context and navigation options, improving the user experience.
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
     *
     * This method is responsible for handling the creation of a new "Barang" resource.
     * It validates the incoming request, processes and cleans up the input data,
     * and stores the data in the database. Additionally, it creates a related record in the "StokBarang" model.
     *
     * @param \App\Http\Requests\StoreBarangRequest $request
     *    The request object containing validated input data for creating a new "Barang".
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects the user back to the "dashboard/regis-barang" page with a success message.
     *
     * Functionality:
     * 1. Retrieves and processes the modal and harga_jual input:
     *    - Strips any commas or formatting from the values.
     *    - Converts them to integers for storage.
     * 2. Validates the request using the rules defined in the `StoreBarangRequest`.
     * 3. Creates a new "Barang" resource with the cleaned and validated data:
     *    - 'nama_barang', 'satuan', 'harga_jual', and 'modal' are stored.
     * 4. Creates a corresponding "StokBarang" record with an initial stock of 0.
     *    - Mirrors the 'nama_barang', 'satuan', 'harga_jual', and 'modal' fields.
     * 5. Redirects the user to the registration dashboard with a success message:
     *    - Provides feedback that the "Barang" has been successfully added.
     *
     * This ensures that both "Barang" and its related stock are initialized correctly in the system.
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
     *
     * This method is responsible for displaying a form to edit an existing "Barang" resource.
     * It retrieves the specific "Barang" item and passes it along with necessary context to the view.
     *
     * @param \App\Models\Barang $regis_barang
     *    The specific "Barang" resource to be edited, passed as a route-model bound parameter.
     *
     * @return \Illuminate\View\View
     *    Returns a view containing the form for editing the specified "Barang" resource.
     *
     * Functionality:
     * 1. Retrieves the "Barang" resource passed via route-model binding:
     *    - The resource is stored in the `$regis_barang` variable.
     * 2. Sets up the view with required variables:
     *    - 'active' => Indicates the currently active menu or tab, set to 'registrasi'.
     *    - 'barang' => The specific "Barang" resource to be edited.
     *    - 'breadcrumb' => Used for breadcrumb navigation, set to 'edit_regisbarang'.
     * 3. Passes these variables to the view located at 'dashboard.regis.regisbarang.edit'.
     *
     * This ensures the user is presented with a pre-filled form for editing the selected "Barang" resource.
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
     *
     * This method is responsible for handling updates to an existing "Barang" resource.
     * It validates the input, processes the data, updates the specified resource in the database,
     * and also updates related records in the "StokBarang" and "BarangMasuk" models.
     *
     * @param \App\Http\Requests\UpdateBarangRequest $request
     *    The request object containing validated input data for updating the "Barang".
     * @param \App\Models\Barang $regis_barang
     *    The specific "Barang" resource to be updated, passed as a route-model bound parameter.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects the user back to the "dashboard/regis-barang" page with a success message.
     *
     * Functionality:
     * 1. Processes the modal and harga_jual input:
     *    - Strips any commas or formatting from the values.
     *    - Converts them to integers for storage.
     * 2. Validates the request using the rules defined in `UpdateBarangRequest`.
     * 3. Updates the "Barang" record in the database:
     *    - Finds the record by its 'id' and updates its fields: 'nama_barang', 'satuan', 'harga_jual', and 'modal'.
     * 4. Updates the corresponding "StokBarang" record:
     *    - Finds the record by matching 'nama_barang' and updates its fields: 'nama_barang', 'satuan', and 'harga_jual'.
     * 5. Updates the corresponding "BarangMasuk" records:
     *    - Updates the 'nama_barang' field for any matching entries.
     * 6. Redirects the user to the registration dashboard with a success message:
     *    - Provides feedback that the "Barang" has been successfully updated.
     *
     * This ensures that both the "Barang" and all related records remain consistent and reflect the latest data.
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
     *
     * This method is responsible for deleting a specific "Barang" resource along with its related records.
     * It ensures that the main "Barang" record and all associated data in "StokBarang" and "BarangMasuk" models
     * are removed to maintain database consistency.
     *
     * @param \App\Models\Barang $regis_barang
     *    The specific "Barang" resource to be deleted, passed as a route-model bound parameter.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects the user back to the "dashboard/regis-barang" page with a success message.
     *
     * Functionality:
     * 1. Deletes related records in the "StokBarang" model:
     *    - Finds and deletes records where 'nama_barang' matches the resource being deleted.
     * 2. Deletes related records in the "BarangMasuk" model:
     *    - Finds and deletes records where 'nama_barang' matches the resource being deleted.
     * 3. Deletes the "Barang" record itself:
     *    - Finds and removes the record by its 'id'.
     * 4. Redirects the user to the registration dashboard with a success message:
     *    - Provides feedback that the "Barang" has been successfully deleted.
     *
     * This ensures that both the "Barang" and all its associated data are completely removed from the system.
     */
    public function destroy(Barang $regis_barang)
    {
        StokBarang::where('nama_barang', $regis_barang->nama_barang)->delete();
        BarangMasuk::where('nama_barang', $regis_barang->nama_barang)->delete();
        Barang::destroy($regis_barang->id);
        return redirect('/dashboard/regis-barang')->with('success', 'Barang telah dihapus!');
    }
}
