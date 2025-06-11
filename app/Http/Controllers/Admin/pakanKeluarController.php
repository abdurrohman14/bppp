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
                'jumlah_keluar' => 'required|numeric',
            ]);

            $pakan = Pakan::findOrFail($request->pakan_id);
            $jumlahKeluar = $pakan->jumlah_pakan - $request->jumlah_keluar;

            if ($jumlahKeluar < 0) {
                return redirect()->back()->with('error', 'Jumlah pakan tidak cukup untuk dikeluarkan');
            }

            pakanKeluar::create($request->all());
            $pakan->update(['jumlah_pakan' => $jumlahKeluar]);

            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakanKeluar = pakanKeluar::findOrFail($id);
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
                'jumlah_keluar' => 'required|numeric',
            ]);

            $pakanKeluar = pakanKeluar::findOrFail($id);
            $pakan = Pakan::findOrFail($request->pakan_id);

            // Hitung selisih dari jumlah keluar sebelumnya dan sekarang
            $jumlahLama = $pakanKeluar->jumlah_keluar;
            $jumlahBaru = $request->jumlah_keluar;
            $selisih = $jumlahBaru - $jumlahLama;

            // Koreksi stok pakan
            $stokBaru = $pakan->jumlah_pakan - $selisih;

            if ($stokBaru < 0) {
                return redirect()->back()->with('error', 'Jumlah pakan tidak cukup setelah perubahan');
            }

            // Update data pakan keluar
            $pakanKeluar->update($request->all());

            // Update stok pakan
            $pakan->update(['jumlah_pakan' => $stokBaru]);

            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            pakanKeluar::findOrFail($id)->delete();
            return redirect()->route('index.pakan.Keluar')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
