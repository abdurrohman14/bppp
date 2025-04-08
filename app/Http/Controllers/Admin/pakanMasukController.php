<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pakanMasuk;
use Illuminate\Http\Request;

class pakanMasukController extends Controller
{
    public function index()
    {
        $pakanMasuk = pakanMasuk::all();
        return view('admin.pakanMasuk.index', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Pakan Masuk',
        ]);
    }

    public function create()
    {
        return view('admin.pakanMasuk.create', [
            'title' => 'Tambah Pakan Masuk',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'jumlah_masuk' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            pakanMasuk::create($request->all());
            return redirect()->route('pakanMasuk.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('pakanMasuk.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakanMasuk = pakanMasuk::find($id);
        return view('admin.pakanMasuk.edit', [
            'pakanMasuk' => $pakanMasuk,
            'title' => 'Edit Pakan Masuk',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pakan_id' => 'required',
                'jumlah_masuk' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            pakanMasuk::find($id)->update($request->all());
            return redirect()->route('pakanMasuk.index')->with(
                'success',
                'Data Berhasil
                Diupdate',
            );
        } catch (\Throwable $th) {
            return redirect()->route('pakanMasuk.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            pakanMasuk::find($id)->delete();
            return redirect()->route('pakanMasuk.index')->with(
                'success',
                'Data Berhasil
            Dihapus',
            );
        } catch (\Throwable $th) {
            return redirect()->route('pakanMasuk.index')->with('error', $th->getMessage());
        }
    }
}
