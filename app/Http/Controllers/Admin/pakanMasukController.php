<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanMasukController extends Controller
{
    public function index()
    {
        $pakanMasuk = PakanMasuk::all();
        return view('admin.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    public function create()
    {
        $pakan = Pakan::all();
        return view('admin.pakanMasuk.create', [
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

            $pakan = Pakan::findOrFail($request->pakan_id);
            $pakan->jumlah_pakan += $request->jumlah_masuk;
            $pakan->save();

            PakanMasuk::create($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('index.pakan.masuk')->with('success', 'Data Berhasil Ditambahkan dan Stok Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakanMasuk = PakanMasuk::findOrFail($id);
        $pakan = Pakan::all();
        return view('admin.pakanMasuk.edit', [
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

            return redirect()->route('index.pakan.masuk')->with('success', 'Data dan Stok Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pakanMasuk = PakanMasuk::findOrFail($id);
            $pakan = Pakan::findOrFail($pakanMasuk->pakan_id);

            // Kurangi stok sesuai jumlah pakan masuk yang akan dihapus
            $pakan->jumlah_pakan -= $pakanMasuk->jumlah_masuk;
            $pakan->save();

            $pakanMasuk->delete();

            return redirect()->route('index.pakan.masuk')->with('success', 'Data dan Stok Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}
