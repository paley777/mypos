<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\StokBarang;
use Illuminate\Support\Facades\Hash;
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
                'total_profit' => Transaction::whereDate('created_at', today())->sum('profit'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::whereDate('created_at', today())->count(),
            ]);
        }
        if (Auth::user()->role == 'Administrator') {
            return view('dashboard.role.index_adm', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_profit' => Transaction::sum('profit'),
                'total_penjualan' => Transaction::sum('total'),
                'total_barangmasuk' => BarangMasuk::whereDate('created_at', today())->count(),
                'total_barangkeluar' => BarangKeluar::whereDate('created_at', today())->count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::count(),
            ]);
        } else {
            return view('dashboard.role.index_cash', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_profit' => Transaction::sum('profit'),
                'total_penjualan' => Transaction::sum('total'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::whereDate('created_at', today())->count(),
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
        return view('dashboard.role.profile.index', [
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
    public function my_profile_edit()
    {
        return view('dashboard.role.profile.edit', [
            'active' => 'beranda',
            'breadcrumb' => 'profile_edit',
        ]);
    }

    public function my_profile_store(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::where('id', auth()->user()->id)->update($validated);

        return redirect('/dashboard/my-profile')->with('success', 'Profil telah diubah!');
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
