<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $email = $request->input('username'); // Ganti username dengan email
    $password = $request->input('password');

    // Cek user di database berdasarkan email
    $user = DB::table('users')->where('email', $email)->first();

    if ($user && Hash::check($password, $user->password)) {
        // Simpan data user ke session
        session(['user' => $user]);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/petugas/pelanggan');
        }
    }

    return back()->with('error', 'Email atau password salah.');
}


public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/');  // Arahkan kembali ke halaman login
}

}