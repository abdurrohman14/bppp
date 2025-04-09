<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spesies;
use Illuminate\Http\Request;

class SpesiesController extends Controller
{
    public function index()
    {
        $spesies = Spesies::all();
        return view('admin.spesies.index', [
            'spesies' => $spesies,
            'title' => 'Spesies',
        ]);
    }

    public function create()
    {
        return view('admin.spesies.create', [
            'title' => 'Tambah Spesies',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_ikan' => 'required',
                'deskripsi' => 'nullable',
            ]);
            Spesies::create($request->all());
            return redirect()->route('index.spesies')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.spesies')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $spesies = Spesies::find($id);
        return view('admin.spesies.edit', [
            'spesies' => $spesies,
            'title' => 'Edit Spesies',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_ikan' => 'required',
                'deskripsi' => 'required',
            ]);
            Spesies::find($id)->update($request->all());
            return redirect()->route('index.spesies')->with(
                'success',
                'Data berhasil di
                update',
            );
        } catch (\Throwable $th) {
            return redirect()->route('index.spesies')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Spesies::destroy($id);
            return redirect()->route('index.spesies')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.spesies')->with('error', $th->getMessage());
        }
    }
}
