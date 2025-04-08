<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all();
        return view('admin.pakan.index', [
            'pakan' => $pakan,
            'title' => 'Pakan',
        ]);
    }

    public function create()
    {
        return view('admin.pakan.create', [
            'title' => 'Tambah Pakan',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_pakan' => 'required',
                'asal_pakan' => 'required',
                'ukuran_pakan' => 'required',
                'jumlah_pakan' => 'required',
            ]);
            Pakan::create($request->all());
            return redirect()->route('admin.pakan.index')->with('success', 'Data Pakan Berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pakan.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pakan = Pakan::find($id);
        return view('admin.pakan.edit', [
            'pakan' => $pakan,
            'title' => 'Edit Pakan',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_pakan' => 'required',
                'asal_pakan' => 'required',
                'ukuran_pakan' => 'required',
                'jumlah_pakan' => 'required',
            ]);
            Pakan::find($id)->update($request->all());
            return redirect()->route('admin.pakan.index')->with(
                'success',
                'Data Pakan Ber
                hasil diupdate',
            );
        } catch (\Throwable $th) {
            return redirect()->route('admin.pakan.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Pakan::find($id)->delete();
            return redirect()->route('admin.pakan.index')->with('success', 'Data Pakan Berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pakan.index')->with('error', $th->getMessage());
        }
    }
}
