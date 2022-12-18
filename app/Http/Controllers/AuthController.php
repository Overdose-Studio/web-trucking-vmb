<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Form login: user need to fill the form to login
    public function formLogin() {
        // If user already login, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // If user not login, show the login form
        return view('auth.login');
    }

    // Login: when user submit the form
    public function login(Request $request) {
        // If user already login, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Validate the form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login data
        $credentials = $request->only('email', 'password');

        // Attempt to login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();  // Regenerate session id
            return redirect()->route('dashboard');  // Redirect to dashboard
        }

        // If login failed, redirect back to login form
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Dashboard: when user want to see the dashboard
    public function dashboard() {
        return view('auth.dashboard');
    }

    // Logout: when user want to logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
