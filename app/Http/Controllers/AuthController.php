<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ======================
    // FORM LUPA PASSWORD
    // ======================
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    // ======================
    // PROSES RESET PASSWORD
    // ======================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'new_password' => 'required|min:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah, silakan login');
    }
}
