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
        // Ambil semua data panen
        $panen = Panen::all();

        // Kirim data ke view
        return view('admin.panen.index', [
            'panen' => $panen,
            'title' => 'Panen',
        ]);
    }

    public function create()
    {
        // Ambil data kolam dan spesies
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        // Kirim data ke view
        return view('admin.panen.create', [
            'title' => 'Tambah Data Panen',
            'kolam' => $kolam,
            'spesies' => $spesies,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input data
            $request->validate([
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',
            ]);

            // Simpan data panen ke database
            Panen::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('index.panen')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        // Ambil data panen berdasarkan ID
        $panen = Panen::find($id);

        // Ambil data kolam dan spesies
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        // Kirim data ke view edit
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
            // Validasi input data
            $request->validate([
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'jumlah_ikan' => 'required|integer',
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',
            ]);

            // Update data panen berdasarkan ID
            Panen::find($id)->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'jumlah_ikan' => $request->jumlah_ikan,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('index.panen')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Hapus data panen berdasarkan ID
            Panen::find($id)->delete();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('index.panen')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
