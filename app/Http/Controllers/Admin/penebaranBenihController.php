<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Spesies;
use App\Models\PenebaranBenih; // huruf kapital di awal kata
use Illuminate\Http\Request;

class penebaranBenihController extends Controller
{
    public function index()
    {
        $penebaranBenih = penebaranBenih::all();
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

            // mendapatkan data kolam
            $kolam = Kolam::findOrFail($request->kolam_id);

            // hitung jumlah ikan setelah penebaran
            $jumlahIkanSekarang = $kolam->jumlah_ikan + $request->jumlah_benih;

            // validasi jumlah ikan tidak melebihi kapasitas kolam
            if ($jumlahIkanSekarang > 2500) {
                return redirect()->back()->with('error', 'Jumlah ikan melebihi kapasitas kolam');
            }
            penebaranBenih::create([
                'kolam_id' => $request->kolam_id,
                'spesies_id' => $request->spesies_id,
                'ukuran' => $request->ukuran,
                'asal_benih' => $request->asal_benih,
                'tanggal_tebar' => $request->tanggal_tebar,
                'jumlah_benih' => $request->jumlah_benih,
            ]);
            // update jumlah ikan di kolam
            $kolam->update(['jumlah_ikan' => $jumlahIkanSekarang]);
            return redirect()->route('index.benih')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $penebaranBenih = penebaranBenih::findOrFail($id);
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
                'kolam_id' => 'required',
                'spesies_id' => 'required',
                'ukuran' => 'required',
                'asal_benih' => 'required',
                'tanggal_tebar' => 'required',
                'jumlah_benih' => 'required',
            ]);
            penebaranBenih::find($id)->update($request->all());
            return redirect()->route('index.benih')->with('success', 'Data Berhasil Di Update');
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            penebaranBenih::find($id)->delete();
            return redirect()->route('index.benih')->with(
                'success',
                'Data
            Berhasil Dihapus',
            );
        } catch (\Throwable $th) {
            return redirect()->route('index.benih')->with('error', $th->getMessage());
        }
    }
}
