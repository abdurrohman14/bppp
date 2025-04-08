<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panen;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    public function index()
    {
        $panen = Panen::all();
        return view('admin.panen.index', [
            'panen' => $panen,
            'title' => 'Panen',
        ]);
    }

    public function create()
    {
        return view('admin.panen.create', [
            'title' => 'Tambah Panen',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kolam_id' => 'required',
                'panen_id' => 'required',
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'harga_per_kg' => 'required',
                'distribusi' => 'required',
            ]);
            Panen::create($request->all());
            return redirect()->route('admin.panen.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $panen = Panen::find($id);
        return view('admin.panen.edit', [
            'panen' => $panen,
            'title' => 'Edit Panen',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kolam_id' => 'required',
                'panen_id' => 'required',
                'tanggal_panen' => 'required',
                'berat_total' => 'required',
                'harga_per_kg' => 'required',
                'distribusi' => 'required',
            ]);
            Panen::find($id)->update($request->all());
            return redirect()->route('admin.panen.index')->with(
                'success',
                'Data berhasil diupdat
            e',
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Panen::find($id)->delete();
            return redirect()->route('admin.panen.index')->with(
                'success',
                'Data berhasil dihapus
            ',
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
