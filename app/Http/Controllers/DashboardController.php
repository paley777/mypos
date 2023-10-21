<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //Index
    public function index()
    {
        if (Auth::user()->role == 'Super Administrator') {
            return view('dashboard.role.index_sa', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_penjualan' => Transaction::sum('total'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::count(),
            ]);
        }
        if (Auth::user()->role == 'Administrator') {
            return view('dashboard.role.index_adm', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_penjualan' => Transaction::sum('total'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::count(),
            ]);
        } else {
            return view('dashboard.role.index_sa', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_penjualan' => Transaction::sum('total'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::count(),
            ]);
        }
    }
    //logout
    /**
     * Handle an logout attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    //logout
    /**
     * Handle an logout attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function my_profile()
    {
        return view('dashboard.role.profile', [
            'active' => 'beranda',
            'breadcrumb' => 'profile',
        ]);
    }
    /**
     * Handle an logout attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('dashboard.about', [
            'active' => 'about',
            'breadcrumb' => 'about',
        ]);
    }
}
