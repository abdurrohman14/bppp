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

    /**
     * Menampilkan form tambah jadwal pakan
     */
    public function create()
    {
        $spesies = Spesies::all();

        return view('admin.JadwalPakan.create', [
            'title' => 'Tambah Jadwal Pakan',
            'spesies' => $spesies,
        ]);
    }

    /**
     * Menyimpan jadwal pakan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'spesies_id' => 'required|exists:spesies,id',
            'jadwal_pakan' => 'required|array|min:1',
            'jadwal_pakan.*' => 'required|date_format:H:i',
        ]);

        try {
            JadwalPakan::create([
                'spesies_id' => $request->spesies_id,
                'jadwal_pakan' => json_encode($request->jadwal_pakan), // Simpan sebagai JSON
            ]);

            return redirect()->route('index.jadwal.pakan')->with('success', 'Jadwal pakan berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit jadwal pakan
     */
    public function edit($id)
    {
        $jadwalPakan = JadwalPakan::findOrFail($id);
        $spesies = Spesies::all();
       $jadwalPakan->jadwal_pakan = json_decode($jadwalPakan->jadwal_pakan);

        return view('admin.JadwalPakan.edit', [
            'jadwalPakan' => $jadwalPakan,
            'spesies' => $spesies,
            'title' => 'Edit Jadwal Pakan',
        ]);
    }

    /**
     * Menyimpan perubahan pada jadwal pakan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'spesies_id' => 'required|exists:spesies,id',
            'jadwal_pakan' => 'required|array|min:1',
            'jadwal_pakan.*' => 'required|date_format:H:i',
        ]);

        try {
            $jadwalPakan = JadwalPakan::findOrFail($id);
            $jadwalPakan->update([
                'spesies_id' => $request->spesies_id,
                'jadwal_pakan' => json_encode($request->jadwal_pakan), // Update sebagai JSON
            ]);

            return redirect()->route('index.jadwal.pakan')->with('success', 'Jadwal pakan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus jadwal pakan
     */
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
