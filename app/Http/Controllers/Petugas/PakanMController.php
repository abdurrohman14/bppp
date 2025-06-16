<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanMController extends Controller
{
    public function index()
    {
        $pakanMasuk = PakanMasuk::all();
        return view('petugas.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    public function create()
    {
        $pakan = Pakan::all();
        return view('petugas.pakanMasuk.create', [
            'pakan' => $pakan,
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            // Tambahkan stok ke pakan
            $pakan = Pakan::findOrFail($request->pakan_id);
            $pakan->jumlah_pakan += $request->jumlah_masuk;
            $pakan->save();

            // Simpan data pakan masuk
            PakanMasuk::create($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('index.petugas.PakanMasuk')
                ->with('success', 'Data berhasil ditambahkan dan stok diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')
                ->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

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

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ]);

            $pakanMasukLama = PakanMasuk::findOrFail($id);

            // Kurangi stok dari pakan lama
            $pakanLama = Pakan::findOrFail($pakanMasukLama->pakan_id);
            $pakanLama->jumlah_pakan -= $pakanMasukLama->jumlah_masuk;
            $pakanLama->save();

            // Tambahkan stok ke pakan baru
            $pakanBaru = Pakan::findOrFail($request->pakan_id);
            $pakanBaru->jumlah_pakan += $request->jumlah_masuk;
            $pakanBaru->save();

            // Update data pakan masuk
            $pakanMasukLama->update([
                'pakan_id' => $request->pakan_id,
                'jumlah_masuk' => $request->jumlah_masuk,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);

            return redirect()->route('index.petugas.PakanMasuk')
                ->with('success', 'Data dan stok berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')
                ->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakan = Pakan::findOrFail($pakanMasuk->pakan_id);

            // Kurangi stok
            $pakan->jumlah_pakan -= $pakanMasuk->jumlah_masuk;
            $pakan->save();

            $pakanMasuk->delete();

            return redirect()->route('index.petugas.PakanMasuk')
                ->with('success', 'Data dan stok berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.PakanMasuk')
                ->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
