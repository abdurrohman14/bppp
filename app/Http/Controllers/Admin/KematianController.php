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

            Kematian::create($request->only(['kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab']));

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
                'tanggal_kematian' => 'date',
                'jumlah_mati' => 'integer|min:1',
                'penyebab' => 'required|string',
            ]);

            $kematian = Kematian::findOrFail($id);
            $kematian->update($request->only(['kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_mati', 'penyebab']));

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
