<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pelanggan;
use App\Models\Order;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.invoice.index', [
            'active' => 'invoice',
            'breadcrumb' => 'invoice',
            'transactions' => Transaction::get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function print(Transaction $transaction)
    {
        return view('dashboard.invoice.invoice', [
            'active' => 'invoice',
            'breadcrumb' => 'invoice',
            'transaction' => $transaction,
            'pelanggan' => Pelanggan::where('nama', $transaction->nama_pelanggan)->first(),
            'orders' => Order::where('kode_inv', $transaction->kode_inv)->get(),
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        Order::where('kode_inv', $transaction->kode_inv)->delete();
        Transaction::destroy($transaction->id);
        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dihapus!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function lunas(Transaction $transaction)
    {
        Transaction::where('kode_inv', $transaction->kode_inv)->update([
            'status' => 'LUNAS',
        ]);

        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dilunaskan!');
    }
}
