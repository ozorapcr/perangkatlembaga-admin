<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;

        // Cek credentials
        if ($this->checkCredentials($username, $email, $password)) {
            // Simpan session login
            session([
                'user_logged_in' => true,
                'user_username' => $username,
                'user_email' => $email,
                'user_role' => $this->getUserRole($username),
                'login_time' => date('Y-m-d H:i:s')
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang ' . $username);
        }

        return back()->withErrors([
            'login_error' => 'Username, email atau password salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        $username = session('user_username', 'User');
        
        // Hapus semua session
        session()->flush();

        return redirect()->route('login')
            ->with('success', "Logout berhasil! Sampai jumpa $username.");
    }

    /**
     * Cek kredensial login
     */
    private function checkCredentials($username, $email, $password)
    {
        $validUsers = [
            'zora' => [
                'email' => 'ozora24si@mahasiswa.pcr.ac.id',
                'password' => 'ozora1002',
                'role' => 'administrator'
            ],
            'user' => [
                'email' => 'user@rw.com', 
                'password' => 'user123',
                'role' => 'user'
            ],
            'ketua' => [
                'email' => 'ketua@rw.com', 
                'password' => 'ketua123',
                'role' => 'ketua_rw'
            ]
        ];

        // Cek jika username ada di validUsers
        if (array_key_exists($username, $validUsers)) {
            $user = $validUsers[$username];
            
            // Cek email dan password
            if ($email === $user['email'] && $password === $user['password']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get user role
     */
    private function getUserRole($username)
    {
        $roles = [
            'admin' => 'administrator',
            'user' => 'user',
            'ketua' => 'ketua_rw'
        ];

        return $roles[$username] ?? 'admin';
    }
}