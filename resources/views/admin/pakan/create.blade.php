<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakan; // Mengganti model dari JenisPakan menjadi Pakan
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all(); // Mengganti variabel dari jenis_pakan menjadi pakan
        return view('admin.pakan.index', [
            'title' => 'Pakan',
            'pakan' => $pakan, // Mengganti variabel dari jenis_pakan menjadi pakan
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
                'jenis_pakan' => 'required|string|max:255',
                'asal_pakan' => 'required|string|max:255',
                'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer', // Menambahkan validasi untuk jumlah_pakan
            ]);

            // Memperbaiki penempatan 'jumlah_pakan' dalam array
            Pakan::create([
                'jenis_pakan' => $request->jenis_pakan,
                'asal_pakan' => $request->asal_pakan,
                'ukuran_pakan' => $request->ukuran_pakan,
                'jumlah_pakan' => $request->jumlah_pakan, // Menambahkan jumlah_pakan di sini
            ]);

            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id); // Mengganti variabel dari jenis_pakan menjadi pakan

        return view('admin.pakan.edit', [
            'title' => 'Edit Pakan',
            'pakan' => $pakan, // Mengganti variabel dari jenis_pakan menjadi pakan
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_pakan' => 'required|string|max:255',
                'asal_pakan' => 'required|string|max:255',
                'ukuran_pakan' => 'required|string|max:100',
                'jumlah_pakan' => 'required|integer', // Menambahkan validasi untuk jumlah_pakan
            ]);

            $pakan = Pakan::findOrFail($id);
            $pakan->fill($request->all())->save(); // Mengganti model dari JenisPakan menjadi Pakan

            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Pakan::findOrFail($id)->delete(); // Mengganti model dari JenisPakan menjadi Pakan
            return redirect()->route('index.pakan')->with('success', 'Pakan berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan')->with('error', $th->getMessage());
        }
    }
}
