<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
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
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kolam_id' => 'required|integer:exists,id',
                'spesies_id' => 'required|integer:exists,id',
                'tanggal_kematian' => 'required|date',
                'jumlah_mati' => 'required|integer|min:1',
            ]);
            Kematian::create($request->all());
            return redirect()->route('admin.kematian.index')->with('success', 'Data Kematian Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.kematian.index')->with('error', $th->getMessage());
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
