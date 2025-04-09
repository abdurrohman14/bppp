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
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);
            return redirect()->route('index.pengguna')->with(
                'success',
                'Pengguna
            berhasil ditambahkan',
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
