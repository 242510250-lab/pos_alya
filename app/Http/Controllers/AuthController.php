<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function auth(Request $request)
    {
        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika email tidak ditemukan
        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('login_error_email', 'Email salah atau tidak terdaftar.');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('login_error_password', 'Password salah.');
        }

        // Login user
        Auth::login($user);

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Masuk dashboard
        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah keluar aplikasi.');
    }
}
