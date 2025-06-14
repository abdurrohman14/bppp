<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanMController extends Controller
{
    // Menampilkan seluruh data Pakan Masuk (role petugas)
    public function index()
    {
        $pakanMasuk = PakanMasuk::all();
        return view('petugas.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    // Form untuk menambah data Pakan Masuk (role petugas)
    public function create()
    {
        $pakan = Pakan::all();

        return view('petugas.pakanMasuk.create', [
            'pakan' => $pakan,
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    // Menyimpan data Pakan Masuk + update stok (sama seperti admin)
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

            return redirect()->route('petugas.pakanMasuk.index')
                ->with('success', 'Data Berhasil Ditambahkan dan Stok Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('petugas.pakanMasuk.index')
                ->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Form untuk edit data Pakan Masuk (role petugas)
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

    // Update data Pakan Masuk + update stok (sama seperti admin)
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakan = Pakan::findOrFail($request->pakan_id);

            // update stok berdasarkan selisih
            $selisihJumlah = $request->jumlah_masuk - $pakanMasuk->jumlah_masuk;
            $pakan->jumlah_pakan += $selisihJumlah;
            $pakan->save();

            // perbarui record pakan masuk
            $pakanMasuk->update($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('petugas.pakanMasuk.index')
                ->with('success', 'Data Berhasil Diupdate dan Stok Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('petugas.pakanMasuk.index')
                ->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Menghapus data Pakan Masuk (role petugas)
    public function destroy($id)
    {
        try {
            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakanMasuk->delete();

            return redirect()->route('petugas.pakanMasuk.index')
                ->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('petugas.pakanMasuk.index')
                ->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}
