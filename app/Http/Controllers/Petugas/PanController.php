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
        try {
            $request->validate([
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_panen' => 'required|date',
                'berat_total' => 'required|numeric',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required|numeric',
                'tujuan_distribusi' => 'required|string',
            ]);

            Panen::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
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
        try {
            $request->validate([
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_panen' => 'required|date',
                'berat_total' => 'required|numeric',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required|numeric',
                'tujuan_distribusi' => 'required|string',
            ]);

            Panen::findOrFail($id)->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Panen::findOrFail($id)->delete();
            return redirect()->route('index.petugas.panen')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
