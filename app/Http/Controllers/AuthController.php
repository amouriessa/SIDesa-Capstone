<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showPendudukRegisterForm()
    {
        return view('auth.register');
    }

    public function showAdminLoginForm()
    {
        $role = Request('role', 'admin'); // Default ke 'user'

        // Validasi apakah role ada di database
        if (!Role::where('name', $role)->exists()) {
            abort(404, 'Role tidak ditemukan.');
        }
        return view('auth.login-admin' ,['role' => $role]);
    }

    public function showPendudukLoginForm()
    {
        $role = Request('role', 'penduduk'); // Default ke 'user'

        // Validasi apakah role ada di database
        if (!Role::where('name', $role)->exists()) {
            abort(404, 'Role tidak ditemukan.');
        }
        return view('auth.login-penduduk', ['role' => $role]);
    }

    // Registrasi penduduk
    public function pendudukRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Perbaikan field untuk validasi unik
            'password' => 'required|string|min:8|confirmed',
            // 'nik' => 'required|numeric|digits:16|unique:users,nik', // Validasi NIK dengan 16 digit
            'no_telepon' => 'required|numeric|digits_between:10,15',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'nik' => $request->nik,
            'no_telepon' => $request->no_telepon,
        ]);

        // Memberikan role Penduduk
        $user->assignRole('penduduk');

        return redirect()->route('pendudukdashboard')
        ->with('success', 'Registration successful. Please login.');
    }

    // Login admin
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = $request->user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admindashboard');
            }
        }

        return Redirect::back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Login penduduk
    public function pendudukLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = $request->user();

            if ($user->hasRole('penduduk')) {
                return redirect()->route('pendudukdashboard');
            }
        }

        return Redirect::back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
