<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Spesies;
use Illuminate\Http\Request;

class SpsController extends Controller
{
    public function index()
    {
        $spesies = Spesies::all();
        return view('petugas.spesies.index', [
            'spesies' => $spesies,
            'title' => 'Spesies',
        ]);
    }

    public function create()
    {
        return view('petugas.spesies.create', [
            'title' => 'Tambah Spesies',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_ikan' => 'required',
                'deskripsi' => 'nullable',
            ]);
            Spesies::create($request->all());
            return redirect()->route('index.petugas.spesies')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.spesies')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $spesies = Spesies::find($id);
        return view('petugas.spesies.edit', [
            'spesies' => $spesies,
            'title' => 'Edit Spesies',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_ikan' => 'required',
                'deskripsi' => 'required',
            ]);
            Spesies::find($id)->update($request->all());
            return redirect()->route('index.petugas.spesies')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.spesies')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Spesies::destroy($id);
            return redirect()->route('index.petugas.spesies')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.spesies')->with('error', $th->getMessage());
        }
    }
}
