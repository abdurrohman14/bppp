<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\UkuranKolam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KlmController extends Controller
{
    public function index()
    {
        $kolam = Kolam::all();

        return view('petugas.kolam.index', [
            'title' => 'Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function create()
    {
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];

        return view('petugas.kolam.create', [
            'title' => 'Tambah Kolam',
            'budaya' => $budaya,
            'status' => $status,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'budaya' => 'required|in:Probiotik,Bioflok',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'jumlah_ikan' => 'nullable|integer',
            'ukuran_kolam' => 'required|',
        ]);

        try {
            $kolam = Kolam::create([
                'nama' => $request->nama,
                'budaya' => $request->budaya,
                'status' => $request->status,
                'jumlah_ikan' => $request->jumlah_ikan,
                'ukuran_kolam' => $request->ukuran_kolam,
            ]);

            $qrData = route('detail.petugas.kolam', $kolam->id); // pastikan route ini ada
            $qrImageName = 'qr_kolam_' . $kolam->id . '.svg';
            $qrPath = 'qrcodes/' . $qrImageName;

            $qrCode = QrCode::format('svg')->size(300)->generate($qrData);
            Storage::disk('public')->put($qrPath, $qrCode);

            $kolam->update([
                'qr_code' => $qrPath,
            ]);

            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $kolam = Kolam::findOrFail($id);

        return view('petugas.kolam.detail', [
            'title' => 'Detail Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function edit($id)
    {
        $kolam = Kolam::findOrFail($id);
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];
        $ukuranKolam = UkuranKolam::all();

        return view('petugas.kolam.edit', [
            'title' => 'Edit Kolam',
            'kolam' => $kolam,
            'budaya' => $budaya,
            'status' => $status,
            'ukuranKolam' => $ukuranKolam,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'budaya' => 'required|in:Probiotik,Bioflok',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'jumlah_ikan' => 'nullable|integer',
            'ukuran_kolam' => 'required|',
        ]);

        try {
            $kolam = Kolam::findOrFail($id);
            $kolam->update([
                'nama' => $request->nama,
                'budaya' => $request->budaya,
                'status' => $request->status,
                'jumlah_ikan' => $request->jumlah_ikan,
                'ukuran_kolam' => $request->ukuran_kolam,
            ]);

            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Kolam::findOrFail($id)->delete();
            return redirect()->route('index.petugas.kolam')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.petugas.kolam')->with('error', $th->getMessage());
        }
    }
}
