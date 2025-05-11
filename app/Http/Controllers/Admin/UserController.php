<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.pengguna.index', [
            'user' => $user,
            'title' => 'Pengguna',
        ]);
    }

    public function create()
    {
        $role = Role::all();
        return view('admin.pengguna.create', [
            'title' => 'Tambah Pengguna',
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'role_id' => 'required',
                'whatsapp' => 'required|string|max:20',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'whatsapp' => $request->whatsapp,
            ]);

            return redirect()->route('index.pengguna')->with(
                'success',
                'Pengguna berhasil ditambahkan'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $role = Role::all(); // Mengambil semua role yang ada

            return view('admin.pengguna.edit', [
                'user' => $user,
                'role' => $role,
                'title' => 'Edit Pengguna',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('index.pengguna')->with('error', 'Pengguna tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'whatsapp' => 'required|string|max:20',
            ]);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
            ]);

            return redirect()->route('index.pengguna')->with('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('index.pengguna')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('index.pengguna')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
