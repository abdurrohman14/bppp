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
            // Validasi input data
            $request->validate([
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',  // Pastikan ada validasi untuk tujuan distribusi
            ]);

            // Simpan data panen ke database
            Panen::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,  // Pastikan tujuan distribusi dimasukkan
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('admin.index.panen')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $panen = Panen::find($id);
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        // Mengirim data kolam dan spesies ke halaman edit
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
                'harga_per_kg' => 'required',
                'tujuan_distribusi' => 'required',  // Pastikan ada validasi untuk tujuan distribusi
            ]);

            // Update data panen berdasarkan ID
            Panen::find($id)->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_panen' => $request->tanggal_panen,
                'berat_total' => $request->berat_total,
                'harga_per_kg' => $request->harga_per_kg,
                'tujuan_distribusi' => $request->tujuan_distribusi,  // Pastikan tujuan distribusi dimasukkan
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('admin.index.panen')->with('success', 'Data berhasil diupdate');
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
            return redirect()->route('admin.index.panen')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
