<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pakanKeluar;
use App\Models\Kolam;
use App\Models\Spesies;
use App\Models\Pakan;
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
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        $pakan = Pakan::all();

        return view('admin.pakanKeluar.create', [
            'title' => 'Tambah Pakan Keluar',
            'kolam' => $kolam,
            'spesies' => $spesies,
            'pakan' => $pakan,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'kolam_id' => 'required|exists:kolams,id',
                'spesies_id' => 'required|exists:spesies,id',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);

            // mendapatkan data pakan berdasarkan ID
            $pakan = Pakan::findOrFail($request->pakan_id); // Pastikan pakan_id valid
            // hitung jumlah pakan keluar
            $jumlahKeluar = $pakan->jumlah_pakan - $request->jumlah_keluar;
            // validasi jumlah pakan tidak kurang dari 0
            if ($jumlahKeluar < 0) {
                return redirect()->back()->with('error', 'Jumlah pakan tidak cukup untuk dikeluarkan');
            }
            pakanKeluar::create($request->all());
            // Perbarui jumlah pakan di model Pakan
            $pakan->update(['jumlah_pakan' => $jumlahKeluar]);
            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakanKeluar = pakanKeluar::find($id);
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        $pakan = Pakan::all();

        return view('admin.pakanKeluar.edit', [
            'pakanKeluar' => $pakanKeluar,
            'kolam' => $kolam,
            'spesies' => $spesies,
            'pakan' => $pakan,
            'title' => 'Edit Pakan Keluar',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required|exists:pakans,id',
                'kolam_id' => 'required|exists:kolams,id',
                'spesies_id' => 'required|exists:spesies,id',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);
            pakanKeluar::find($id)->update($request->all());
            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            pakanKeluar::find($id)->delete();
            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
