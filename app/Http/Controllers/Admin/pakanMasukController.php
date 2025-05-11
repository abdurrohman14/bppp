<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PakanMasuk; // Pastikan nama model PakanMasuk mengikuti konvensi penamaan
use App\Models\Pakan; // Pastikan model Pakan sudah ada
use Illuminate\Http\Request;

class PakanMasukController extends Controller
{
    // Menampilkan seluruh data Pakan Masuk
    public function index()
    {
        // Ambil data PakanMasuk
        $pakanMasuk = PakanMasuk::all(); // Tidak perlu dengan relasi 'pakan' karena hanya pakan_id yang digunakan
        return view('admin.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    // Form untuk menambah data Pakan Masuk
    public function create()
    {
        // Ambil data pakan
        $pakan = Pakan::all(); // Ambil data pakan dari model Pakan

        return view('admin.pakanMasuk.create', [
            'pakan' => $pakan, // Pass data pakan
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    // Menyimpan data Pakan Masuk
    public function store(Request $request)
    {
        try {
            // Validasi input dari form
            $request->validate([
                'pakan_id' => 'required', // Pastikan 'pakan_id' ada di form
                'jumlah_masuk' => 'required|numeric', // Pastikan jumlah masuk adalah angka
                'tanggal_masuk' => 'required|date', // Menambahkan validasi tanggal
            ]);

            // Membuat record baru di database
            PakanMasuk::create($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));
            return redirect()->route('index.pakan.masuk')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Form untuk mengedit data Pakan Masuk
    public function edit($id)
    {
        $pakanMasuk = PakanMasuk::findOrFail($id);  // Temukan data berdasarkan ID
        $pakan = Pakan::all(); // Ambil data pakan

        return view('admin.pakanMasuk.edit', [
            'pakanMasuk' => $pakanMasuk,
            'pakan' => $pakan, // Pass data pakan
            'title' => 'Edit Pakan Masuk',
        ]);
    }

    // Memperbarui data Pakan Masuk
    public function update(Request $request, $id)
    {
        try {
            // Validasi input dari form
            $request->validate([
                'pakan_id' => 'required', // Pastikan 'pakan_id' ada di form
                'jumlah_masuk' => 'required|numeric', // Validasi angka untuk jumlah masuk
                'tanggal_masuk' => 'required|date', // Validasi tanggal
            ]);

            $pakanMasuk = PakanMasuk::findOrFail($id);  
            // Perbarui record berdasarkan data input
            $pakanMasuk->update($request->only(['pakan_id', 'jumlah_masuk', 'tanggal_masuk']));

            return redirect()->route('index.pakan.masuk')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    // Menghapus data Pakan Masuk
    public function destroy($id)
    {
        try {
            $pakanMasuk = PakanMasuk::findOrFail($id);  
            // Hapus data berdasarkan ID
            $pakanMasuk->delete();

            return redirect()->route('index.pakan.masuk')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.pakan.masuk')->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}
