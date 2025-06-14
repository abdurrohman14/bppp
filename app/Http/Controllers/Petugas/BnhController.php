<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Spesies;
use App\Models\PenebaranBenih;
use Illuminate\Http\Request;

class BnhController extends Controller
{
    public function index()
    {
        $penebaranBenih = PenebaranBenih::all();
        return view('petugas.benih.index', [
            'penebaranBenih' => $penebaranBenih,
            'title' => 'Penebaran Benih',
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        return view('petugas.benih.create', [
            'title' => 'Tambah Penebaran Benih',
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
                'ukuran' => 'required',
                'asal_benih' => 'required',
                'tanggal_tebar' => 'required',
                'jumlah_benih' => 'required|numeric|min:1',
            ]);

            // Ambil data kolam
            $kolam = Kolam::findOrFail($request->kolam_id);

            // Hitung total ikan setelah ditambah benih
            $jumlahIkanSekarang = $kolam->jumlah_ikan + $request->jumlah_benih;

            // Validasi kapasitas maksimum kolam
            if ($jumlahIkanSekarang > 2500) {
                return redirect()->back()->with('error', 'Jumlah ikan melebihi kapasitas kolam');
            }

            // Simpan data penebaran benih
            PenebaranBenih::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'ukuran' => $request->ukuran,
                'asal_benih' => $request->asal_benih,
                'tanggal_tebar' => $request->tanggal_tebar,
                'jumlah_benih' => $request->jumlah_benih,
            ]);

            // Update jumlah ikan di kolam
            $kolam->update(['jumlah_ikan' => $jumlahIkanSekarang]);

            return redirect()->route('index.petugas.benih')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.benih')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $penebaranBenih = PenebaranBenih::findOrFail($id);
        return view('petugas.benih.edit', [
            'benih' => $penebaranBenih,
            'kolam' => Kolam::all(),
            'spesies' => Spesies::all(),
            'title' => 'Edit Penebaran Benih',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kolam_id' => 'required|exists:kolams,id',
                'spesies_id' => 'required|exists:spesies,id',
                'ukuran' => 'required',
                'asal_benih' => 'required',
                'tanggal_tebar' => 'required',
                'jumlah_benih' => 'required|numeric|min:1',
            ]);

            PenebaranBenih::findOrFail($id)->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'ukuran' => $request->ukuran,
                'asal_benih' => $request->asal_benih,
                'tanggal_tebar' => $request->tanggal_tebar,
                'jumlah_benih' => $request->jumlah_benih,
            ]);

            return redirect()->route('index.petugas.benih')->with('success', 'Data Berhasil Di Update');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.benih')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            PenebaranBenih::findOrFail($id)->delete();
            return redirect()->route('index.petugas.benih')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.benih')->with('error', $th->getMessage());
        }
    }
}
