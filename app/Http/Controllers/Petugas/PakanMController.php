<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanMController extends Controller
{
    // Menampilkan seluruh data Pakan Masuk
    public function index()
    {
        $pakanMasuk = PakanMasuk::all();
        return view('petugas.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    // Form untuk menambah data Pakan Masuk
    public function create()
    {
        $pakan = Pakan::all();

        return view('petugas.pakanMasuk.create', [
            'pakan' => $pakan,
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    // Menyimpan data Pakan Masuk
    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            $pakan = Pakan::findOrFail($request->pakan_id);
            $jumlahMasuk = $pakan->jumlah_pakan + $request->jumlah_masuk;

            PakanMasuk::create($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));
            $pakan->update(['jumlah_pakan' => $jumlahMasuk]);

            return redirect()->route('index.petugas.PakanMasuk')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Form untuk mengedit data Pakan Masuk
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

    // Memperbarui data Pakan Masuk
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
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

    // Menghapus data Pakan Masuk
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
