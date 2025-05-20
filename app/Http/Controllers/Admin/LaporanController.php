<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kolam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
     public function index(Request $request)
    {
        $jenis = $request->input('jenis', 'bulanan'); // Default to 'bulanan'
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan', date('m'));

        // Get the filtered data
        $laporan = Kolam::with(['penebaran', 'kualitasAir', 'mortalitas', 'panen'])
            ->get()
            ->map(function ($kolam) use ($jenis, $bulan, $tahun) {
                $filter = fn($item) =>
                    ($jenis === 'tahunan'
                        ? $item->tahun == $tahun
                        : ($item->tahun == $tahun && $item->bulan == $bulan));

                $penebaran = $kolam->penebaran->filter($filter);
                $kualitasAir = $kolam->kualitasAir->filter($filter);
                $mortalitas = $kolam->mortalitas->filter($filter);
                $panen = $kolam->panen->filter($filter);

                return (object) [
                    'nama_kolam' => $kolam->nama,
                    'total_penebaran' => $penebaran->sum('jumlah'),
                    'rata_rata_suhu' => round($kualitasAir->avg('suhu'), 2),
                    'rata_rata_ph' => round($kualitasAir->avg('ph'), 2),
                    'rata_rata_do' => round($kualitasAir->avg('do'), 2),
                    'total_mortalitas' => $mortalitas->sum('jumlah'),
                    'total_panen' => $panen->sum('berat'),
                    'total_nilai_panen' => $panen->sum('total_harga'),
                ];
            });

        return view('admin.laporan.index', [
            'title' => 'Laporan',
            'jenis' => $jenis,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $laporan,
        ]);
    }

    public function generate(Request $request)
    {
        $jenis = $request->input('jenis', 'bulanan');
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan', date('m'));

        $laporan = Kolam::with(['penebaran', 'kualitasAir', 'mortalitas', 'panen'])
            ->get()
            ->map(function ($kolam) use ($jenis, $bulan, $tahun) {
                $filter = fn($item) =>
                    ($jenis === 'tahunan'
                        ? $item->tahun == $tahun
                        : ($item->tahun == $tahun && $item->bulan == $bulan));

                $penebaran = $kolam->penebaran->filter($filter);
                $kualitasAir = $kolam->kualitasAir->filter($filter);
                $mortalitas = $kolam->mortalitas->filter($filter);
                $panen = $kolam->panen->filter($filter);

                return (object) [
                    'nama_kolam' => $kolam->nama,
                    'total_penebaran' => $penebaran->sum('jumlah'),
                    'rata_rata_suhu' => round($kualitasAir->avg('suhu'), 2),
                    'rata_rata_ph' => round($kualitasAir->avg('ph'), 2),
                    'rata_rata_do' => round($kualitasAir->avg('do'), 2),
                    'total_mortalitas' => $mortalitas->sum('jumlah'),
                    'total_panen' => $panen->sum('berat'),
                    'total_nilai_panen' => $panen->sum('total_harga'),
                ];
            });

        $pdf = PDF::loadView('admin.laporan.pdf', [
            'laporan' => $laporan,
            'jenis' => $jenis,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('a4', 'landscape');

        return $pdf->download("laporan_{$jenis}_{$tahun}" . ($jenis == 'bulanan' ? "_{$bulan}" : '') . ".pdf");
    }
}
