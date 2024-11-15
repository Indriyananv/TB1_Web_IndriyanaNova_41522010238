<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Fungsi untuk proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect('/admin/halaman');
            }else{
                return redirect('/user/halaman');
            }
        }
        // Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Fungsi untuk menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register');
    }

    // Fungsi untuk proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set role ke 'user' secara otomatis
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        if($user->role == 'admin'){
            return redirect('/admin/halaman');
        }else{
            return redirect('/user/halaman');
        }
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
