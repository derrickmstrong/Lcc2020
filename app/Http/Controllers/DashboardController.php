<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Applying Auth middleware for all Dashboard views
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // dd(auth()->user()->posts); // For Testing

        return view('dashboard');
    }
}
