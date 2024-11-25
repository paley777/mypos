<?php

/**
 * PiutangController
 *
 * This controller handles the management of debts (Piutang), including listing, partial payments, and marking debts as paid.
 * It interacts with both the "Piutang" and "Transaction" models to ensure financial consistency.
 */

namespace App\Http\Controllers;

use App\Models\Piutang;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Shows a list of all outstanding debts (Piutang) with an optional search filter.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.piutang.index', [
            'active' => 'piutang',
            'breadcrumb' => 'piutang',
            'piutangs' => Piutang::orderBy('kode_inv', 'desc')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    /**
     * Handle payment for a debt.
     *
     * Processes a partial or full payment for an outstanding debt, updates the debt and associated transaction,
     * and deletes the debt record if it is fully paid.
     *
     * @param \Illuminate\Http\Request $request
     *    The HTTP request containing payment details.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects to the debt list with a success message.
     */
    public function bayar(Request $request)
    {
        $kode_inv = $request->kode_inv;
        $bayar = intval(str_replace([','], '', $request->bayar));
        $sisa_bayar = intval(str_replace([','], '', $request->sisa_bayar));
        $transaction = Transaction::where('kode_inv', $kode_inv)->first();

        if ($sisa_bayar == 0) {
            // Full payment
            $total = $transaction->total;

            Transaction::where('kode_inv', $kode_inv)->update([
                'status' => 'LUNAS',
                'kembalian' => 0,
                'bayar' => $total,
            ]);

            // Delete the debt record
            Piutang::where('kode_inv', $kode_inv)->delete();
        } else {
            // Partial payment
            Piutang::where('kode_inv', $kode_inv)->update([
                'sisa_bayar' => $sisa_bayar,
            ]);

            Transaction::where('kode_inv', $kode_inv)->update([
                'bayar' => $transaction->bayar + $bayar,
                'kembalian' => '-' . $sisa_bayar,
            ]);
        }

        return redirect('/dashboard/piutang')->with('success', 'Piutang telah dibayar!');
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
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        // Reserved for future use
    }

    /**
     * Display the specified resource.
     *
     * Currently not implemented.
     *
     * @param \App\Models\Piutang $piutang
     */
    public function show(Piutang $piutang)
    {
        // Reserved for future use
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Currently not implemented.
     *
     * @param \App\Models\Piutang $piutang
     */
    public function edit(Piutang $piutang)
    {
        // Reserved for future use
    }

    /**
     * Update the specified resource in storage.
     *
     * Currently not implemented.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Piutang $piutang
     */
    public function update(Request $request, Piutang $piutang)
    {
        // Reserved for future use
    }

    /**
     * Remove the specified resource from storage.
     *
     * Currently not implemented.
     *
     * @param \App\Models\Piutang $piutang
     */
    public function destroy(Piutang $piutang)
    {
        // Reserved for future use
    }
}
