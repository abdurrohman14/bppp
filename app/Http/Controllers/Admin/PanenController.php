<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Panen;
use App\Models\Spesies;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    public function index()
    {
        $panen = Panen::all();

        return view('admin.panen.index', [
            'panen' => $panen,
            'title' => 'Panen',
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        return view('admin.panen.create', [
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
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',
            ]);

            $kolam = Kolam::findOrFail($request->kolam_id);

            if ($kolam->jumlah_ikan < $request->jumlah_ikan) {
                return redirect()->back()->with('error', 'Jumlah ikan panen melebihi jumlah ikan di kolam.');
            }

            // Kurangi jumlah ikan di kolam
            $kolam->jumlah_ikan -= $request->jumlah_ikan;
            $kolam->save();

            Panen::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            return redirect()->route('index.panen')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        return view('admin.panen.edit', [
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
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',
            ]);

            $panen = Panen::findOrFail($id);
            $kolam = Kolam::findOrFail($request->kolam_id);

            // Kembalikan jumlah ikan sebelumnya
            $kolam->jumlah_ikan += $panen->jumlah_ikan;

            // Cek apakah cukup untuk dikurangi
            if ($kolam->jumlah_ikan < $request->jumlah_ikan) {
                return redirect()->back()->with('error', 'Jumlah ikan panen melebihi jumlah ikan di kolam.');
            }

            // Kurangi jumlah ikan sesuai permintaan baru
            $kolam->jumlah_ikan -= $request->jumlah_ikan;
            $kolam->save();

            $panen->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            return redirect()->route('index.panen')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $panen = Panen::findOrFail($id);
            $kolam = Kolam::findOrFail($panen->kolam_id);

            // Kembalikan jumlah ikan ke kolam
            $kolam->jumlah_ikan += $panen->jumlah_ikan;
            $kolam->save();

            $panen->delete();

            return redirect()->route('index.panen')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
