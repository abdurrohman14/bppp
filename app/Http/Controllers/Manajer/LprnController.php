<?php

namespace App\Http\Controllers\Manajer;

use Carbon\Carbon;
use App\Models\Kolam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\LaporanExports;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LprnController extends Controller
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
                'rata_rata_suhu' => round($kualitasAir->map(fn($item) => (float) $item->temperatur)->avg() ?? 0, 2),
                'rata_rata_ph' => round($kualitasAir->map(fn($item) => (float) $item->ph)->avg() ?? 0, 2),
                'rata_rata_do' => round($kualitasAir->map(fn($item) => (float) $item->oksigen_terlarut)->avg() ?? 0, 2),
                'total_mortalitas' => $mortalitas->sum('jumlah_mati'),
                'jumlah_keluar' => $pakanKeluar->sum('jumlah_keluar'),
                'total_panen' => $panen->sum('berat_total'),
                'total_nilai_panen' => $panen->sum(function ($item) {
                    return $item->berat_total * $item->harga_per_kg;
                }),
            ];
        });

    // Hitung total untuk baris "Total"
    $totalKolam = $laporan->count();

    $total = (object) [
        'total_penebaran' => $laporan->sum('total_penebaran'),
        'rata_rata_suhu' => $totalKolam ? round($laporan->sum('rata_rata_suhu') / $totalKolam, 2) : 0,
        'rata_rata_ph' => $totalKolam ? round($laporan->sum('rata_rata_ph') / $totalKolam, 2) : 0,
        'rata_rata_do' => $totalKolam ? round($laporan->sum('rata_rata_do') / $totalKolam, 2) : 0,
        'total_mortalitas' => $laporan->sum('total_mortalitas'),
        'jumlah_keluar' => $laporan->sum('jumlah_keluar'),
        'total_panen' => $laporan->sum('total_panen'),
        'total_nilai_panen' => $laporan->sum('total_nilai_panen'),
    ];

    return view('admin.laporan.index', [
        'title' => 'Laporan',
        'jenis' => $jenis,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'laporan' => $laporan,
        'total' => $total,
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

    public function exportExcel(Request $request)
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

        $filename = "laporan_{$jenis}_{$tahun}" . ($jenis == 'bulanan' ? "_{$bulan}" : '') . ".xlsx";

        return Excel::download(new LaporanExports($laporan, $jenis, $tahun, $bulan), $filename);
    }
}
