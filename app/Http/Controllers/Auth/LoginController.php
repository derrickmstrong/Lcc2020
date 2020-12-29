<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validate data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // sign in user
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid email and/or password');
        };

        // redirect
        return redirect()->route('dashboard');
    }
}
