<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Spesies;
use App\Models\PenebaranBenih;
use Illuminate\Http\Request;

class penebaranBenihController extends Controller
{
    public function index()
    {
        $penebaranBenih = PenebaranBenih::all();
        return view('admin.benih.index', [
            'penebaranBenih' => $penebaranBenih,
            'title' => 'Penebaran Benih',
        ]);
    }

    public function create()
    {
        $kolam = Kolam::all();
        $spesies = Spesies::all();
        return view('admin.benih.create', [
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
                'jumlah_benih' => 'required',
            ]);

            $kolam = Kolam::findOrFail($request->kolam_id);
            $jumlahIkanSekarang = $kolam->jumlah_ikan + $request->jumlah_benih;

            if ($jumlahIkanSekarang > 2500) {
                return redirect()->back()->with('error', 'Jumlah ikan melebihi kapasitas kolam');
            }

            PenebaranBenih::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'ukuran' => $request->ukuran,
                'asal_benih' => $request->asal_benih,
                'tanggal_tebar' => $request->tanggal_tebar,
                'jumlah_benih' => $request->jumlah_benih,
            ]);

            $kolam->update(['jumlah_ikan' => $jumlahIkanSekarang]);

            return redirect()->route('index.benih')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $penebaranBenih = PenebaranBenih::findOrFail($id);
        return view('admin.benih.edit', [
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
                'jumlah_benih' => 'required',
            ]);

            PenebaranBenih::findOrFail($id)->update([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'ukuran' => $request->ukuran,
                'asal_benih' => $request->asal_benih,
                'tanggal_tebar' => $request->tanggal_tebar,
                'jumlah_benih' => $request->jumlah_benih,
            ]);

            return redirect()->route('index.benih')->with('success', 'Data Berhasil Di Update');
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            PenebaranBenih::findOrFail($id)->delete();
            return redirect()->route('index.benih')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }
}
