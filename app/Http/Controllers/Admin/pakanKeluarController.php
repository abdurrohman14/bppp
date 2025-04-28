<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pakanKeluar;
use App\Models\Kolam;  // Pastikan model Kolam di-import
use App\Models\Spesies;  // Pastikan model Spesies di-import
use App\Models\Pakan;    // Pastikan model Pakan di-import
use Illuminate\Http\Request;

class pakanKeluarController extends Controller
{
    public function index()
    {
        $pakanKeluar = pakanKeluar::all();
        return view('admin.pakanKeluar.index', [
            'pakanKeluar' => $pakanKeluar,
            'title' => 'Pakan Keluar',
        ]);
    }

    public function create()
    {
        // Mengambil data yang dibutuhkan
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        $pakan = Pakan::all();

        return view('admin.pakanKeluar.create', [
            'title' => 'Tambah Pakan Keluar',
            'kolam' => $kolam,     // Mengirim data kolam ke view
            'spesies' => $spesies, // Mengirim data spesies ke view
            'pakan' => $pakan,     // Mengirim data pakan ke view
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);
            pakanKeluar::create($request->all());
            return redirect()->route('pakanKeluar.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakanKeluar = pakanKeluar::find($id);
        return view('admin.pakanKeluar.edit', [
            'pakanKeluar' => $pakanKeluar,
            'title' => 'Edit Pakan Keluar',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);
            pakanKeluar::find($id)->update($request->all());
            return redirect()->route('pakanKeluar.index')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            pakanKeluar::find($id)->delete();
            return redirect()->route('pakanKeluar.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
