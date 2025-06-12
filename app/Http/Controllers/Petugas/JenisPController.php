<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;

class JenisPController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all(); // Mengambil semua data pakan
        return view('petugas.JenisPakan.index', [
            'title' => 'Jenis Pakan',
            'pakan' => $pakan,
        ]);
    }

    public function create()
    {
        return view('petugas.JenisPakan.create', [
            'title' => 'Tambah Jenis Pakan',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_pakan' => 'required|string|max:255',
                'asal_pakan' => 'required|string|max:255',
                // 'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer',
            ]);

            // Menyimpan data baru ke dalam database
            Pakan::create([
                'jenis_pakan' => $request->jenis_pakan,
                'asal_pakan' => $request->asal_pakan,
                // 'ukuran_pakan' => $request->ukuran_pakan,
                'jumlah_pakan' => $request->jumlah_pakan,
            ]);

            return redirect()->route('index.petugas.JenisPakan')->with('success', 'Jenis Pakan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.JenisPakan')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id); // Mengambil data pakan berdasarkan id
        return view('petugas.JenisPakan.edit', [
            'title' => 'Edit Jenis Pakan',
            'pakan' => $pakan,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_pakan' => 'required|string|max:255',
                'asal_pakan' => 'required|string|max:255',
                // 'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer',
            ]);

            $pakan = Pakan::findOrFail($id); // Menemukan pakan yang akan diupdate
            $pakan->fill($request->all())->save(); // Menyimpan perubahan data pakan

            return redirect()->route('index.petugas.JenisPakan')->with('success', 'Jenis Pakan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.JenisPakan')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Pakan::findOrFail($id)->delete(); // Menghapus pakan berdasarkan id
            return redirect()->route('index.petugas.JenisPakan')->with('success', 'Jenis Pakan berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.JenisPakan')->with('error', $th->getMessage());
        }
    }
}
