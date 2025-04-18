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
            'title' => 'Tambah Penebaran Kematian',
            'kolam' => $kolam,
            'spesies' => $spesies,
        ]);

        return view('admin.kematian.create', [
            'title' => 'Tambah Data Kematian',
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
            Kematian::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'tanggal_kematian' => $request->tanggal_kematian,
                'jumlah_mati' => $request->jumlah_mati,
                'penyebab' => $request->penyebab,
            ]);
            return redirect()->route('index.kematian')->with('success', 'Data Kematian Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.kematian')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $kematian = Kematian::find($id);
        return view('admin.kematian.edit', [
            'title' => 'Edit Data Kematian',
            'kematian' => $kematian,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kolam_id' => 'required|integer:exists,id',
                'spesies_id' => 'required|integer:exists,id',
                'tanggal_kematian' => 'required|date',
                'jumlah_mati' => 'required|integer|min:1',
            ]);
            $kematian = Kematian::findOrFail($id);
            $kematian->fill($request->all());
            $kematian->save();
            return redirect()->route('admin.kematian.index')->with(
                'success',
                'Data Kemat
                ian Berhasil Diupdate',
            );
        } catch (\Throwable $th) {
            return redirect()->route('admin.kematian.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Kematian::find($id)->delete();
            return redirect()->route('admin.kematian.index')->with(
                'success',
                'Data Kemat
            ian Berhasil Dihapus',
            );
        } catch (\Throwable $th) {
            return redirect()->route('admin.kematian.index')->with('error', $th->getMessage());
        }
    }
}
