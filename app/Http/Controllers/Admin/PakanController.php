<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakan; // Mengganti model dari JenisPakan menjadi Pakan
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all(); // Mengambil semua data pakan
        return view('admin.pakan.index', [
            'title' => 'Pakan',
            'pakan' => $pakan,
        ]);
    }

    public function create()
    {
        return view('admin.pakan.create', [
            'title' => 'Tambah Pakan',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan' => 'required|string|max:255', // Mengganti jenis_pakan menjadi pakan
                'asal_pakan' => 'required|string|max:255',
                'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer',
            ]);

            // Menyimpan data baru ke dalam database
            Pakan::create([
                'pakan' => $request->pakan, // Menggunakan pakan
                'asal_pakan' => $request->asal_pakan,
                'ukuran_pakan' => $request->ukuran_pakan,
                'jumlah_pakan' => $request->jumlah_pakan,
            ]);

            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id); // Mengambil data pakan berdasarkan id
        return view('admin.pakan.edit', [
            'title' => 'Edit Pakan',
            'pakan' => $pakan,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan' => 'required|string|max:255',
                'asal_pakan' => 'required|string|max:255',
                'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer',
            ]);

            $pakan = Pakan::findOrFail($id); // Menemukan pakan yang akan diupdate
            $pakan->fill($request->all())->save(); // Menyimpan perubahan data pakan

            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Pakan::findOrFail($id)->delete(); // Menghapus pakan berdasarkan id
            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }
}
