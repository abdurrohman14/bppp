<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kolam;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('index.admin.laporan');
    }

    public function generate(Request $request)
    {
        $jenis = $request->input('jenis'); // 'bulanan' atau 'tahunan'
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporan = Kolam::with(['penebaran', 'kualitasAir', 'mortalitas', 'panen'])->get()
            ->map(function ($kolam) use ($jenis, $bulan, $tahun) {
                $filter = fn($item) => 
                    ($jenis === 'tahunan' ? $item->tahun == $tahun : ($item->tahun == $tahun && $item->bulan == $bulan));

                $penebaran = $kolam->penebaran->filter($filter);
                $kualitasAir = $kolam->kualitasAir->filter($filter);
                $mortalitas = $kolam->mortalitas->filter($filter);
                $panen = $kolam->panen->filter($filter);

                return [
                    'nama_kolam' => $kolam->nama,
                    'total_penebaran' => $penebaran->sum('jumlah'),
                    'rata_suhu' => round($kualitasAir->avg('suhu'), 2),
                    'rata_ph' => round($kualitasAir->avg('ph'), 2),
                    'rata_do' => round($kualitasAir->avg('do'), 2),
                    'total_mortalitas' => $mortalitas->sum('jumlah'),
                    'total_panen' => $panen->sum('berat'),
                    'total_nilai_panen' => $panen->sum('total_harga'),
                ];
            });

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'laporan' => $laporan,
            'jenis' => $jenis,
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->setPaper('a4', 'landscape');

        return $pdf->download("laporan_{$jenis}_{$bulan}_{$tahun}.pdf");
    }
}
