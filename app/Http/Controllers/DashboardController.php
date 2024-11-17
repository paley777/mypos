<?php

/**
 * DashboardController
 *
 * This controller manages the functionality and data presented in the dashboard for users based on their roles.
 * It handles dynamic role-based views, logout functionality, profile management, and general informational pages.
 */

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
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard homepage based on user roles.
     *
     * Shows different dashboards for Super Administrators, Administrators, and regular users (Cashiers).
     * Each role-specific view contains data and statistics relevant to the user's role.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profits = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(profit) as total_profit'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(7) // Fetch last 7 days
            ->get();

        // Format data for the view
        $profits = $profits->map(function ($profit) {
            return [
                'date' => \Carbon\Carbon::parse($profit->date)->translatedFormat('d F Y'),
                'total_profit' => number_format($profit->total_profit, 0, ',', '.'),
            ];
        });
        if (Auth::user()->role == 'Super Administrator') {
            return view('dashboard.role.index_sa', [
                'active' => 'beranda',
                'breadcrumb' => 'beranda',
                'total_profit' => Transaction::whereDate('created_at', today())->sum('profit'),
                'total_barang' => Barang::count(),
                'total_stok' => StokBarang::sum('stok'),
                'total_inv' => Transaction::whereDate('created_at', today())->count(),
                'profits' => $profits,
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
        }

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

    /**
     * Handle user logout.
     *
     * Invalidates the user session and regenerates the CSRF token for security purposes.
     * Redirects the user to the homepage after successful logout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Display the user's profile page.
     *
     * Shows the profile of the currently authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function my_profile()
    {
        return view('dashboard.role.profile.index', [
            'active' => 'beranda',
            'breadcrumb' => 'profile',
        ]);
    }

    /**
     * Display the profile editing form.
     *
     * Provides a form for the user to update their profile information.
     *
     * @return \Illuminate\View\View
     */
    public function my_profile_edit()
    {
        return view('dashboard.role.profile.edit', [
            'active' => 'beranda',
            'breadcrumb' => 'profile_edit',
        ]);
    }

    /**
     * Store updated profile information.
     *
     * Validates and saves the updated profile information. Updates the password if provided.
     *
     * @param \App\Http\Requests\UpdateProfileRequest $request
     *    Validated request containing profile data.
     *
     * @return \Illuminate\Http\RedirectResponse
     *    Redirects back to the profile page with a success message.
     */
    public function my_profile_store(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::where('id', auth()->user()->id)->update($validated);

        return redirect('/dashboard/my-profile')->with('success', 'Profil telah diubah!');
    }

    /**
     * Display the "About" page.
     *
     * Provides general information about the application or organization.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('dashboard.about', [
            'active' => 'about',
            'breadcrumb' => 'about',
        ]);
    }
}
