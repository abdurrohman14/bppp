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
        return view('admin.kematian.create', [
            'title' => 'Tambah Data Kematian',
            'kolam' => Kolam::all(),
            'spesies' => Spesies::all(),
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

            $kolam = Kolam::findOrFail($request->kolam_id);

            // Kurangi jumlah ikan di kolam
            $jumlahBaru = $kolam->jumlah_ikan - $request->jumlah_mati;
            if ($jumlahBaru < 0) $jumlahBaru = 0;
            $kolam->update(['jumlah_ikan' => $jumlahBaru]);

            Kematian::create($request->only([
                'kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab'
            ]));

            $totalHariIni = Kematian::where('kolam_id', $request->kolam_id)
                ->where('tanggal_kematian', $request->tanggal_kematian)
                ->sum('jumlah_mati');

            $batasMortalitas = 3;
            if ($totalHariIni > $batasMortalitas) {
                return redirect()->route('index.kematian')
                    ->with('success', 'Data Kematian Berhasil Ditambahkan')
                    ->with('warning', 'Peringatan: Jumlah kematian ikan melebihi batas aman (3 ekor) di hari ini.');
            }

            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Ditambahkan');

        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.kematian.edit', [
            'title' => 'Edit Data Kematian',
            'kematian' => Kematian::findOrFail($id),
            'kolam' => Kolam::all(),
            'spesies' => Spesies::all(),
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
            $kolam = Kolam::findOrFail($kematian->kolam_id);

            // Tambahkan kembali jumlah_mati lama
            $kolam->jumlah_ikan += $kematian->jumlah_mati;

            // Kurangi dengan jumlah_mati baru
            $kolam->jumlah_ikan -= $request->jumlah_mati;
            if ($kolam->jumlah_ikan < 0) $kolam->jumlah_ikan = 0;

            $kolam->save();

            $kematian->update($request->only([
                'kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab'
            ]));

            $totalHariIni = Kematian::where('kolam_id', $request->kolam_id)
                ->where('tanggal_kematian', $request->tanggal_kematian)
                ->where('id', '!=', $kematian->id)
                ->sum('jumlah_mati');

            $totalHariIni += $request->jumlah_mati;

            $batasMortalitas = 3;
            if ($totalHariIni > $batasMortalitas) {
                return redirect()->route('index.kematian')
                    ->with('success', 'Data Kematian Berhasil Diupdate')
                    ->with('warning', 'Peringatan: Jumlah kematian ikan melebihi batas aman (3 ekor) di hari ini.');
            }

            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Diupdate');

        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kematian = Kematian::findOrFail($id);
            $kolam = Kolam::findOrFail($kematian->kolam_id);

            $kolam->jumlah_ikan += $kematian->jumlah_mati;
            $kolam->save();

            $kematian->delete();

            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }
}
