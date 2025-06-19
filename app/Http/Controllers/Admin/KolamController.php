<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kolam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KolamController extends Controller
{
    public function index()
    {
        $kolam = Kolam::all();

        return view('admin.kolam.index', [
            'title' => 'Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function create()
    {
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];

        return view('admin.kolam.create', [
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
            'ukuran_kolam' => 'required|string|max:255',
        ]);

        try {
            $kolam = Kolam::create([
                'nama' => $request->nama,
                'budaya' => $request->budaya,
                'status' => $request->status,
                'jumlah_ikan' => $request->jumlah_ikan,
                'ukuran_kolam' => $request->ukuran_kolam,
            ]);

            // Buat data untun QR Code
            // $qrData = route('detail.kolam', $kolam->id); // pastikan route ini ada
            $qrData = 'http://192.168.1.39:8000/detail-kolam/' . $kolam->id;

            $qrImageName = 'qr_kolam_' . $kolam->id . '.svg';
            $qrPath = 'qrcodes/' . $qrImageName;

            // Simpan QR Code ke storage/app/public/qrcodes
            $qrCode = QrCode::format('svg')->size(300)->generate($qrData);
            Storage::disk('public')->put($qrPath, $qrCode);

            // Update kolam dengan path QR Code
            $kolam->update([
                'qr_code' => $qrPath,
            ]);

            return redirect()->route('index.kolam')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $kolam = Kolam::findOrFail($id);

        return view('admin.kolam.detail', [
            'title' => 'Detail Kolam',
            'kolam' => $kolam,
        ]);
    }

    public function edit($id)
    {
        $kolam = Kolam::findOrFail($id);
        $budaya = ['Probiotik', 'Bioflok'];
        $status = ['Aktif', 'Tidak Aktif'];

        return view('admin.kolam.edit', [
            'title' => 'Edit Kolam',
            'kolam' => $kolam,
            'budaya' => $budaya,
            'status' => $status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'budaya' => 'required|in:Probiotik,Bioflok',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'jumlah_ikan' => 'nullable|integer',
            'ukuran_kolam' => 'required|string|max:255',
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

            return redirect()->route('index.kolam')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Kolam::findOrFail($id)->delete();

            return redirect()->route('index.kolam')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index.kolam')->with('error', $th->getMessage());
        }
    }

    public function showPublic($id) {
        $kolam = Kolam::find($id);
        return view('public.detail_kolam', compact('kolam'));
    }
}
