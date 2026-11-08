<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Public registration disabled
     */
    public function create()
    {
        return redirect('/login')->with('message', 'Public registration is disabled. Administrator access is strictly controlled.');
    }

    /**
     * Public registration submission disabled
     */
    public function store(Request $request)
    {
        return redirect('/login')->with('message', 'Public registration is disabled. Administrator access is strictly controlled.');
    }

    /**
     * Admin logout
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/jobs')->with('message', 'You have successfully logged out.');
    }

    /**
     * Admin login page
     */
    public function login()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect('/jobs');
        }

        return view('login');
    }

    /**
     * Process Admin Login
     */
    public function loginNow(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($fields)) {
            // Check if user is an active admin (Main Admin or Secondary Admin)
            if (!auth()->user()->isAdmin()) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Access denied. You do not have administrator privileges.'])->onlyInput('email');
            }

            $request->session()->regenerate();
            $adminType = auth()->user()->isMainAdmin() ? 'Main Administrator' : 'Administrator';
            return redirect('/jobs')->with('message', "Welcome, " . auth()->user()->name . "! Logged in as {$adminType}.");
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
    }
}
