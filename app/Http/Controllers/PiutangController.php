<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use App\Models\Transaction;
use Illuminate\Http\Request;


class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
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

    public function bayar(Request $request)
    {
        $kode_inv = $request->kode_inv;
        $bayar = intval(str_replace([','], '', $request->bayar));
        $sisa_bayar = intval(str_replace([','], '', $request->sisa_bayar));
        $transaction = Transaction::where('kode_inv', $request->kode_inv)->first();


        if ($sisa_bayar == 0) {
            // Retrieve the total value from the Transaction table

            $total = $transaction->total;

            Transaction::where('kode_inv', $request->kode_inv)->update([
                'status' => 'LUNAS',
                'kembalian' => 0,
                'bayar' => $total,
            ]);

            // delete piutang
            Piutang::where('kode_inv', $kode_inv)->delete();
        } else {
            Piutang::where('kode_inv', $kode_inv)->update([
                'sisa_bayar' => $sisa_bayar,
            ]);

            Transaction::where('kode_inv', $request->kode_inv)->update([
                'bayar' => $transaction->bayar + $bayar,
                'kembalian' => "-" . $sisa_bayar,
            ]);
        }

        return redirect('/dashboard/piutang')->with('success', 'Piutang telah dibayar!');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Piutang $piutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Piutang $piutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Piutang $piutang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piutang $piutang)
    {
        //
    }
}
