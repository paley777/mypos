<?php

/**
 * LandingController
 * 
 * This controller manages the landing page and authentication for the application.
 * It provides functionality for displaying the homepage and handling user login attempts.
 */

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LandingController extends Controller
{
    /**
     * Display the homepage.
     * 
     * Renders the landing page with navigation state.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('landing.index', [
            'active' => 'index',
        ]);
    }

    /**
     * Handle an authentication attempt.
     * 
     * Validates user login credentials, attempts authentication, and redirects upon success or failure.
     * 
     * @param \Illuminate\Http\Request $request
     *    The HTTP request containing login credentials.
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     *    Redirects to the dashboard on successful login or back to the login page on failure.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Selamat Datang di Dashboard MyPOS V2!');
        }

        return back()->with('loginError', 'E-mail/Password Anda Salah, Coba Lagi!');
    }
}
