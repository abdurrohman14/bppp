<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanMController extends Controller
{
    // Tampilkan seluruh data Pakan Masuk
    public function index()
    {
        $pakanMasuk = PakanMasuk::all();
        return view('petugas.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    // Form tambah data
    public function create()
    {
        $pakan = Pakan::all();
        return view('petugas.pakanMasuk.create', [
            'pakan' => $pakan,
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    // Simpan data
    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            PakanMasuk::create($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('index.petugas.PakanMasuk')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Form edit data
    public function edit($id)
    {
        $pakanMasuk = PakanMasuk::findOrFail($id);
        $pakan = Pakan::all();
        return view('petugas.pakanMasuk.edit', [
            'pakanMasuk' => $pakanMasuk,
            'pakan' => $pakan,
            'title' => 'Edit Pakan Masuk',
        ]);
    }

    // Update data
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakanMasuk->update($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('index.petugas.PakanMasuk')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Hapus data
    public function destroy($id)
    {
        try {
            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakanMasuk->delete();

            return redirect()->route('index.petugas.PakanMasuk')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}
