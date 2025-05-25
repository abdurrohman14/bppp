<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use Illuminate\Http\Request;

class KolamController extends Controller
{
    public function index()
    {
        $kolam = Kolam::all();
        return view('admin.kolam.index', [
            'title' => 'Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('admin.kolam.create', [
            'budaya' => $budaya,
            'status' => $status,
            'kolam' => $kolam,
            'title' => 'Tambah Kolam',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'budaya' => 'required|in:Probiotik,Bioflok',
                'status' => 'required|in:Aktif,Tidak Aktif',
                'jumlah_ikan' => 'nullable|integer',
            ]);
            Kolam::create($request->all());
            return redirect()->route('index.kolam')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $kolam = Kolam::find($id);
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('admin.kolam.edit', [
            'title' => 'Edit Kolam',
            'kolam' => $kolam,
            'budaya' => $budaya,
            'status' => $status,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'budaya' => 'required|string|max:255',
                'status' => 'required|string|max:50',
                'jumlah_ikan' => 'nullable|integer',
            ]);
            $kolam = Kolam::findOrFail($id);
            $kolam->fill($request->all());
            $kolam->save();
            return redirect()->route('index.kolam')->with(
                'success',
                'Data berhasil di
                update',
            );
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            Kolam::find($id)->delete();
            return redirect()->route('index.kolam')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }
}
