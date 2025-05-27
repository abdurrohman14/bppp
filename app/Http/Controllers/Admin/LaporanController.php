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
        $jenis = $request->input('jenis', 'bulanan');

        if ($jenis === 'bulanan') {
            $tahun_bulan = $request->input('tahun_bulan', date('Y-m'));
            [$tahun, $bulan] = explode('-', $tahun_bulan);
        } else {
            $tahun = $request->input('tahun', date('Y'));
            $bulan = null;
        }

        $laporan = Kolam::with(['penebaran', 'kualitasAir', 'mortalitas', 'panen', 'pakanKeluar'])
            ->get()
            ->map(function ($kolam) use ($jenis, $bulan, $tahun) {
                $filter = function ($item, $dateField) use ($jenis, $bulan, $tahun) {
                    $date = \Carbon\Carbon::parse($item->{$dateField});
                    return $jenis === 'tahunan'
                        ? $date->year == $tahun
                        : ($date->year == $tahun && $date->month == $bulan);
                };

                $penebaran = $kolam->penebaran->filter(fn($item) => $filter($item, 'tanggal_tebar'));
                $kualitasAir = $kolam->kualitasAir->filter(fn($item) => $filter($item, 'tanggal_pengukuran'));
                $mortalitas = $kolam->mortalitas->filter(fn($item) => $filter($item, 'tanggal_kematian'));
                $panen = $kolam->panen->filter(fn($item) => $filter($item, 'tanggal_panen'));
                $pakanKeluar = $kolam->pakanKeluar->filter(fn($item) => $filter($item, 'tanggal_keluar'));

                return (object) [
                    'nama_kolam' => $kolam->nama,
                    'total_penebaran' => $penebaran->sum('jumlah_benih'),
                    'rata_rata_suhu' => round($kualitasAir->avg('temperatur'), 2),
                    'rata_rata_ph' => round($kualitasAir->avg('ph'), 2),
                    'rata_rata_do' => round($kualitasAir->avg('oksigen_terlarut'), 2),
                    'total_mortalitas' => $mortalitas->sum('jumlah_mati'),
                    'jumlah_keluar' => $pakanKeluar->sum('jumlah_keluar'),
                    'total_panen' => $panen->sum('berat_total'),
                    'total_nilai_panen' => $panen->sum(function ($item) {
                        return $item->berat_total * $item->harga_per_kg;
                    }),
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

        if ($jenis === 'bulanan') {
            $tahun_bulan = $request->input('tahun_bulan', date('Y-m'));
            [$tahun, $bulan] = explode('-', $tahun_bulan);
        } else {
            $tahun = $request->input('tahun', date('Y'));
            $bulan = null;
        }

        $laporan = Kolam::with(['penebaran', 'kualitasAir', 'mortalitas', 'panen', 'pakanKeluar'])
            ->get()
            ->map(function ($kolam) use ($jenis, $bulan, $tahun) {
                $filter = function ($item, $dateField) use ($jenis, $bulan, $tahun) {
                    $date = \Carbon\Carbon::parse($item->{$dateField});
                    return $jenis === 'tahunan'
                        ? $date->year == $tahun
                        : ($date->year == $tahun && $date->month == $bulan);
                };

                $penebaran = $kolam->penebaran->filter(fn($item) => $filter($item, 'tanggal_tebar'));
                $kualitasAir = $kolam->kualitasAir->filter(fn($item) => $filter($item, 'tanggal_pengukuran'));
                $mortalitas = $kolam->mortalitas->filter(fn($item) => $filter($item, 'tanggal_kematian'));
                $panen = $kolam->panen->filter(fn($item) => $filter($item, 'tanggal_panen'));
                $pakanKeluar = $kolam->pakanKeluar->filter(fn($item) => $filter($item, 'tanggal_keluar'));

                return (object) [
                    'nama_kolam' => $kolam->nama,
                    'total_penebaran' => $penebaran->sum('jumlah_benih'),
                    'rata_rata_suhu' => round($kualitasAir->avg('temperatur'), 2),
                    'rata_rata_ph' => round($kualitasAir->avg('ph'), 2),
                    'rata_rata_do' => round($kualitasAir->avg('oksigen_terlarut'), 2),
                    'total_mortalitas' => $mortalitas->sum('jumlah_mati'),
                    'jumlah_keluar' => $pakanKeluar->sum('jumlah_keluar'),
                    'total_panen' => $panen->sum('berat_total'),
                    'total_nilai_panen' => $panen->sum(function ($item) {
                        return $item->berat_total * $item->harga_per_kg;
                    }),
                ];
            });

        $pdf = PDF::loadView('admin.laporan.pdf', [
            'laporan' => $laporan,
            'jenis' => $jenis,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('a4', 'landscape');

        return $pdf->download("laporan_{$jenis}{$tahun}" . ($jenis == 'bulanan' ? "{$bulan}" : '') . ".pdf");
    }
}
