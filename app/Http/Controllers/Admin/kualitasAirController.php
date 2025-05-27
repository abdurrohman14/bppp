<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KualitasAir;
use App\Models\Kolam;
use Illuminate\Http\Request;

class KualitasAirController extends Controller
{
    public function index()
    {
        $air = KualitasAir::with('kolam')->get();
        return view('admin.kualitas_air.index', [
            'title' => 'Kualitas Air',
            'air' => $air
        ]);
    }

    public function create()
    {
        $kolams = Kolam::all();
        return view('admin.kualitas_air.create', [
            'title' => 'Tambah Kualitas Air',
            'kolams' => $kolams
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kolam_id' => 'required|exists:kolams,id',
            'tanggal_pengukuran' => 'required|date',
            'ph' => 'required|numeric',
            'temperatur' => 'required|numeric',
            'oksigen_terlarut' => 'required|numeric',
        ]);

        try {
            $data = $request->all();
            KualitasAir::create($data);

            $messages = $this->validateKualitasAir($data);
            $notif = $this->generateNotification($messages);

            return redirect()->route('kualitas_air.index')
                ->with('success', 'Data berhasil ditambahkan.')
                ->with('warning', $notif);
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')
                ->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $air = KualitasAir::findOrFail($id);
        $kolams = Kolam::all();
        return view('admin.kualitas_air.edit', [
            'title' => 'Edit Kualitas Air',
            'air' => $air,
            'kolams' => $kolams
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kolam_id' => 'required|exists:kolams,id',
            'tanggal_pengukuran' => 'required|date',
            'ph' => 'required|numeric',
            'temperatur' => 'required|numeric',
            'oksigen_terlarut' => 'required|numeric',
        ]);

        try {
            $air = KualitasAir::findOrFail($id);
            $air->update($request->all());

            $messages = $this->validateKualitasAir($request->all());
            $notif = $this->generateNotification($messages);

            return redirect()->route('kualitas_air.index')
                ->with('success', 'Data berhasil diupdate.')
                ->with('warning', $notif);
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')
                ->with('error', 'Gagal mengupdate data: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $air = KualitasAir::findOrFail($id);
            $air->delete();

            return redirect()->route('kualitas_air.index')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('kualitas_air.index')
                ->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    private function validateKualitasAir(array $data): array
    {
        $messages = [];

        if (isset($data['ph'])) {
            if ($data['ph'] < 6) {
                $messages['pH'] = 'rendah';
            } elseif ($data['ph'] > 9) {
                $messages['pH'] = 'tinggi';
            }
        }

        if (isset($data['oksigen_terlarut'])) {
            if ($data['oksigen_terlarut'] < 3) {
                $messages['Oksigen Terlarut'] = 'rendah';
            } elseif ($data['oksigen_terlarut'] > 8) {
                $messages['Oksigen Terlarut'] = 'tinggi';
            }
        }

        if (isset($data['temperatur'])) {
            if ($data['temperatur'] < 20) {
                $messages['Suhu'] = 'rendah';
            } elseif ($data['temperatur'] > 30) {
                $messages['Suhu'] = 'tinggi';
            }
        }

        return $messages;
    }

    private function generateNotification(array $messages): string
    {
        $count = count($messages);

        if ($count === 0) {
            return '';
        }

        $text = 'Peringatan: ';
        $desc = [];

        foreach ($messages as $param => $level) {
            $desc[] = "$param terlalu $level";
        }

        if ($count === 3) {
            return $text . 'Semua parameter kualitas air berada di luar batas aman. ' . implode(', ', $desc) . '. Harap cek kondisi kolam.';
        }

        if ($count === 2) {
            return $text . 'Dua parameter kualitas air bermasalah yaitu: ' . implode(' dan ', $desc) . '. Harap cek kondisi kolam.';
        }

        if ($count === 1) {
            return $text . $desc[0] . '. Harap cek kondisi kolam.';
        }

        return $text . implode(', ', $desc) . '.';
    }
}
