<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        // cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        // update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silahkan login.');
    }
}
