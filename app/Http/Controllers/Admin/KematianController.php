<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
use App\Models\Kolam;
use App\Models\Spesies;
use Illuminate\Http\Request;

class KematianController extends Controller
{
    public function index()
    {
        $kematian = Kematian::all();
        return view('admin.kematian.index', [
            'title' => 'Data Kematian',
            'kematian' => $kematian,
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        return view('admin.kematian.create', [
            'title' => 'Tambah Data Kematian',
            'kolam' => $kolam,
            'spesies' => $spesies,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kolam_id' => 'required|exists:kolams,id',
                'spesies_id' => 'required|exists:spesies,id',
                'tanggal_kematian' => 'required|date',
                'jumlah_mati' => 'required|integer|min:1',
                'penyebab' => 'required|string',
            ]);

            $kematian = Kematian::create($request->only([
                'kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab'
            ]));

            $totalHariIni = Kematian::where('kolam_id', $request->kolam_id)
                ->where('tanggal_kematian', $request->tanggal_kematian)
                ->sum('jumlah_mati');

            $batasMortalitas = 5;

            if ($totalHariIni > $batasMortalitas) {
                return redirect()->route('index.kematian')
                    ->with('success', 'Data Kematian Berhasil Ditambahkan')
                    ->with('warning', 'Peringatan: Jumlah kematian ikan di kolam ini melebihi batas aman 5 ekor hari ini. Harap periksa keadaan kolam.');
            }

            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Ditambahkan');

        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $kematian = Kematian::findOrFail($id);
        $kolam = Kolam::all();
        $spesies = Spesies::all();

        return view('admin.kematian.edit', [
            'title' => 'Edit Data Kematian',
            'kematian' => $kematian,
            'kolam' => $kolam,
            'spesies' => $spesies,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kolam_id' => 'required|exists:kolams,id',
                'spesies_id' => 'required|exists:spesies,id',
                'tanggal_kematian' => 'required|date',
                'jumlah_mati' => 'required|integer|min:1',
                'penyebab' => 'required|string',
            ]);

            $kematian = Kematian::findOrFail($id);

            $kematian->update($request->only([
                'kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab'
            ]));

            // Hitung ulang jumlah kematian di hari yang sama TANPA data ini
            $totalHariIni = Kematian::where('kolam_id', $request->kolam_id)
                ->where('tanggal_kematian', $request->tanggal_kematian)
                ->where('id', '!=', $kematian->id)
                ->sum('jumlah_mati');

            // Tambahkan jumlah baru dari request
            $totalHariIni += $request->jumlah_mati;

            $batasMortalitas = 5;

            if ($totalHariIni > $batasMortalitas) {
                return redirect()->route('index.kematian')
                    ->with('success', 'Data Kematian Berhasil Diupdate')
                    ->with('warning', 'Peringatan: Jumlah kematian ikan di kolam ini melebihi batas aman 5 ekor hari ini. Harap periksa keadaan kolam.');
            }

            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Diupdate');

        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Kematian::findOrFail($id)->delete();
            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }
}
