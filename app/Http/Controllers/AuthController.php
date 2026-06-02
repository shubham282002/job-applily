<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration page dikhao
    public function showRegister()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    try {
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect('/dashboard')->with('success', 'Account banaya gaya!');
    } catch (\Exception $e) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 422);
        }
        return back()->withErrors(['general' => 'Kuch error aa gaya!']);
    }
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect('/dashboard')->with('success', 'Login successful!');
    }

    if ($request->wantsJson()) {
        return response()->json(['email' => 'Invalid credentials!'], 422);
    }

    return back()->withErrors([
        'email' => 'Email ya password galat hai!',
    ]);
}

    // Login page dikhao
    public function showLogin()
    {
        return view('auth.login');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout ho gaye!');
    }
}
