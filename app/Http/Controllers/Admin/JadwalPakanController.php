<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPakan;
use App\Models\Spesies;

class JadwalPakanController extends Controller
{
    public function index()
    {
        $jadwalPakan = JadwalPakan::with('spesies')->get();

        return view('admin.JadwalPakan.index', [
            'jadwalPakan' => $jadwalPakan,
            'title' => 'Jadwal Pakan',
        ]);
    }

    public function create()
    {
        $spesies = Spesies::all();

        return view('admin.JadwalPakan.create', [
            'title' => 'Tambah Jadwal Pakan',
            'spesies' => $spesies,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Menambahkan validasi input
            $request->validate([
                'spesies_id' => 'required|exists:spesies,id',
                'jadwal_pakan' => 'required|array|min:1',  // Validasi bahwa jadwal_pakan adalah array dan tidak kosong
                'jadwal_pakan.*' => 'required|date_format:H:i',  // Format waktu H:i untuk setiap elemen jadwal_pakan
            ]);

            // Menyimpan jadwal_pakan sebagai string yang dipisahkan oleh koma
            $jadwal = implode(', ', $request->jadwal_pakan);

            JadwalPakan::create([
                'spesies_id' => $request->spesies_id,
                'jadwal_pakan' => $jadwal,
            ]);

            return redirect()->route('index.jadwal.pakan')->with('success', 'Jadwal pakan berhasil disimpan');
        } catch (\Exception $e) {
            // Menangani error dengan pesan yang lebih jelas
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jadwalPakan = JadwalPakan::findOrFail($id);
        $spesies = Spesies::all();

        return view('admin.JadwalPakan.edit', [
            'jadwalPakan' => $jadwalPakan,
            'spesies' => $spesies,
            'title' => 'Edit Jadwal Pakan',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Menambahkan validasi input untuk update
            $request->validate([
                'spesies_id' => 'required|exists:spesies,id',
                'jadwal_pakan' => 'required|array|min:1',
                'jadwal_pakan.*' => 'required|date_format:H:i',
            ]);

            // Menyimpan jadwal_pakan yang sudah diperbarui
            $jadwal = implode(', ', $request->jadwal_pakan);

            $jadwalPakan = JadwalPakan::findOrFail($id);
            $jadwalPakan->spesies_id = $request->spesies_id;
            $jadwalPakan->jadwal_pakan = $jadwal;
            $jadwalPakan->save();

            return redirect()->route('index.jadwal.pakan')->with('success', 'Jadwal pakan berhasil diperbarui');
        } catch (\Exception $e) {
            // Menangani error dengan pesan yang lebih jelas
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jadwalPakan = JadwalPakan::findOrFail($id);
            $jadwalPakan->delete();

            return redirect()->route('index.jadwal.pakan')->with('success', 'Jadwal pakan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
