<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get(); // Ambil semua user dengan relasi roles
        return view('admin.manajemenuser.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Ambil semua role
        return view('admin.manajemenuser.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_telepon' => 'required|string|max:15',
            'role' => 'required|string|exists:roles,name', // Validasi role dari Spatie
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
        ]);

        // Assign role menggunakan Spatie
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        return redirect()->route('daftaruser.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all(); // Ambil semua role
        $userRole = $user->roles->first()->name ?? ''; // Ambil role pertama user (Spatie mendukung banyak role)
        return view('admin.manajemenuser.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'no_telepon' => 'required|string|max:15',
            'role' => 'required|string|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sinkronisasi role
        $role = Role::findByName($request->role);
        $user->syncRoles([$role]);

        return redirect()->route('daftaruser.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('daftaruser.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Filter users by role.
     */
    public function filterRole(Request $request)
    {
        $roles = $request->input('role', ['admin', 'penduduk']); // Role untuk filter
        $users = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })->with('roles:name')->get();

        return view('admin.manajemenuser.index', compact('users'));
    }
}
