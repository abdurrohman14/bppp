<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\penebaranBenih;
use Illuminate\Http\Request;

class penebaranBenihController extends Controller
{
    public function index()
    {
        $penebaranBenih = penebaranBenih::all();
        return view('admin.penebaranBenih.index', [
            'penebaranBenih' => $penebaranBenih,
            'title' => 'Penebaran Benih',
        ]);
    }

    public function create()
    {
        return view('admin.penebaranBenih.create', [
            'title' => 'Tambah Penebaran Benih',
        ]);
    }

    public function store(Request $request)
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
            penebaranBenih::create($request->all());
            return redirect()->route('penebaranBenih.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('penebaranBenih.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $penebaranBenih = penebaranBenih::find($id);
        return view('admin.penebaranBenih.edit', [
            'penebaranBenih' => $penebaranBenih,
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
            return redirect()->route('penebaranBenih.index')->with('success', 'Data Berhasil Di Update');
        } catch (\Throwable $th) {
            return redirect()->route('penebaranBenih.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            penebaranBenih::find($id)->delete();
            return redirect()->route('penebaranBenih.index')->with(
                'success',
                'Data
            Berhasil Dihapus',
            );
        } catch (\Throwable $th) {
            return redirect()->route('penebaranBenih.index')->with('error', $th->getMessage());
        }
    }
}
