<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Panen;
use App\Models\Spesies;
use Illuminate\Http\Request;

class PanController extends Controller
{
    public function index()
    {
        $panen = Panen::all();
        return view('petugas.panen.index', [
            'panen' => $panen,
            'title' => 'Panen',
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        return view('petugas.panen.create', [
            'title' => 'Tambah Data Panen',
            'kolam' => $kolam,
            'spesies' => $spesies,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kolam_id' => 'required',
            'spesies_id' => 'required',
            'tanggal_panen' => 'required',
            'berat_total' => 'required',
            'harga_per_kg' => 'required',
            'tujuan_distribusi' => 'required',
        ]);

        Panen::create([
            'kolam_id' => $request->kolam_id,
            'spesies_id' => $request->spesies_id,
            'tanggal_panen' => $request->tanggal_panen,
            'berat_total' => $request->berat_total,
            'harga_per_kg' => $request->harga_per_kg,
            'tujuan_distribusi' => $request->tujuan_distribusi,
        ]);

        return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        return view('petugas.panen.edit', [
            'panen' => $panen,
            'kolam' => $kolam,
            'spesies' => $spesies,
            'title' => 'Edit Panen',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kolam_id' => 'required',
            'spesies_id' => 'required',
            'tanggal_panen' => 'required',
            'berat_total' => 'required',
            'harga_per_kg' => 'required',
            'tujuan_distribusi' => 'required',
        ]);

        Panen::findOrFail($id)->update([
            'kolam_id' => $request->kolam_id,
            'spesies_id' => $request->spesies_id,
            'tanggal_panen' => $request->tanggal_panen,
            'berat_total' => $request->berat_total,
            'harga_per_kg' => $request->harga_per_kg,
            'tujuan_distribusi' => $request->tujuan_distribusi,
        ]);

        return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Panen::findOrFail($id)->delete();
        return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil dihapus');
    }
}
