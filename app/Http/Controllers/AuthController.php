<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        // Jika user sudah login, arahkan ke dashboard
        if (Session::get('user_logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    /**
     * Tampilkan halaman register.
     */
    public function showRegisterForm()
    {
        // Jika user sudah login, tidak perlu register lagi
        if (Session::get('user_logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request)
    {
        // Validasi input tanpa konfirmasi password
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        // Simpan user ke database
        User::create([
            'name' => ucfirst($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Ambil data user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek user dan password
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan data ke session
            Session::put('user_logged_in', true);
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_email', $user->email);

            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
        }

        // Jika gagal login
        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Logout user (hapus session).
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
