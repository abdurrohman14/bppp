<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KualitasAir;
use App\Models\Kolam;
use Illuminate\Http\Request;

class KualitasAirController extends Controller
{
    public function index() {
        $air = kualitasAir::with('kolam')->get();
        return view('admin.kualitas_air.index', [
            'title' => 'Kualitas Air',
            'air' => $air
        ]);
    }

    public function create() {
        $kolams = Kolam::all();
        return view('admin.kualitas_air.create', [
            'title' => 'Tambah Kualitas Air',
            'kolams' => $kolams
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'kolam_id' => 'required|exists:kolams,id',
                'tanggal_pengukuran' => 'required|date',
                'ph' => 'required|numeric',
                'temperatur' => 'required|numeric',
                'oksigen_terlarut' => 'required|numeric',
            ]);            

            KualitasAir::create($request->all());

            return redirect()->route('kualitas_air.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id) {
        $air = KualitasAir::findOrFail($id);
        $kolams = Kolam::all();
        return view('admin.kualitas_air.edit', [
            'title' => 'Edit Kualitas Air',
            'air' => $air,
            'kolams' => $kolams
        ]);
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'kolam_id' => 'required|exists:kolams,id',
                'tanggal_pengukuran' => 'required|date',
                'ph' => 'required|numeric',
                'temperatur' => 'required|numeric',
                'oksigen_terlarut' => 'required|numeric',
            ]);

            $air = KualitasAir::findOrFail($id);
            $air->update($request->all());

            return redirect()->route('kualitas_air.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $air = KualitasAir::findOrFail($id);
            $air->delete();

            return redirect()->route('kualitas_air.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')->with('error', $th->getMessage());
        }
    }
}
