<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            return view('dashboard.super_admin');
        }

        if ($user->hasRole('bendahara')) {
            return view('dashboard.bendahara');
        }

        if ($user->hasRole('guru')) {
            return view('dashboard.guru');
        }

        return view('dashboard.user');
    }
}
