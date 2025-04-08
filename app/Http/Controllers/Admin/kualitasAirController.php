<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kualitasAir;
use Illuminate\Http\Request;

class kualitasAirController extends Controller
{
    public function index() {
        $air = kualitasAir::all();
        return view('admin.kualitasair.index', [
            'title' => 'Kualitas Air',
            'air' => $air
        ]);
    }

    public function create() {
        return view('admin.kualitasair.create', [
            'title' => 'Tambah Kualitas Air'
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'kolam_id' => 'required',
                'tanggal_pengukuran' => 'required',
                'pH' => 'required',
                'temperature' => 'required',
                'do' => 'required',
            ]);
            kualitasAir::create($request->all());
            return redirect()->route('kualitasair.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('kualitasair.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id) {
        $air = kualitasAir::find($id);
        return view('admin.kualitasair.edit', [
            'title' => 'Edit Kualitas Air',
            'air' => $air
        ]);
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'kolam_id' => 'required',
                'tanggal_pengukuran' => 'required',
                'pH' => 'required',
                'temperature' => 'required',
                'do' => 'required',
                ]);
                kualitasAir::find($id)->update($request->all());
                return redirect()->route('kualitasair.index')->with('success', 'Data Berhasil
                Diupdate');
        } catch (\Throwable $th) {
                return redirect()->route('kualitasair.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            kualitasAir::find($id)->delete();
            return redirect()->route('kualitasair.index')->with('success', 'Data Berhasil
            Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('kualitasair.index')->with('error', $th->getMessage());
        }
    }
}
