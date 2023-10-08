<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //Index
    public function index()
    {
        if (Auth::user()->role == 'Super Administrator') {
            return view('dashboard.superadmin.index');
        }
    }
}
