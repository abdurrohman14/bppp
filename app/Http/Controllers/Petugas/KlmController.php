<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use Illuminate\Http\Request;

class KlmController extends Controller
{
    public function index()
    {
        $kolam = Kolam::all();
        return view('petugas.kolam.index', [
            'title' => 'Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function create()
    {
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('petugas.kolam.create', [
            'budaya' => $budaya,
            'status' => $status,
            'title' => 'Tambah Kolam',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'budaya' => 'required|in:Probiotik,Bioflok',
                'status' => 'required|in:Aktif,Tidak Aktif',
                'jumlah_ikan' => 'nullable|integer',
            ]);
            Kolam::create($request->all());
            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $kolam = Kolam::findOrFail($id);
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('petugas.kolam.edit', [
            'title' => 'Edit Kolam',
            'kolam' => $kolam,
            'budaya' => $budaya,
            'status' => $status,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'budaya' => 'required|string|max:255',
                'status' => 'required|string|max:50',
                'jumlah_ikan' => 'nullable|integer',
            ]);
            $kolam = Kolam::findOrFail($id);
            $kolam->fill($request->all());
            $kolam->save();
            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Kolam::findOrFail($id)->delete();
            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }
}
