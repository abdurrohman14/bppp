<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\pakanKeluar;
use App\Models\Kolam;
use App\Models\Spesies;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanKController extends Controller
{
    public function index()
    {
        $pakanKeluar = pakanKeluar::all();
        return view('petugas.pakanKeluar.index', [
            'pakanKeluar' => $pakanKeluar,
            'title' => 'Pakan Keluar',
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        $pakan = Pakan::all();

        return view('petugas.pakanKeluar.create', [
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
                'pakan_id' => 'required',
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);

            pakanKeluar::create($request->all());

            return redirect()->route('index.petugas.PakanKeluar')->with('success', 'Data Berhasil Ditambahkan');
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

        return view('petugas.pakanKeluar.edit', [
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
                'pakan_id' => 'required',
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'tanggal_keluar' => 'required',
                'jumlah_keluar' => 'required',
            ]);

            pakanKeluar::find($id)->update($request->all());

            return redirect()->route('index.petugas.PakanKeluar')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            pakanKeluar::find($id)->delete();
            return redirect()->route('index.petugas.PakanKeluar')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
