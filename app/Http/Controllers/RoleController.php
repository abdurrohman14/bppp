<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Kolam;
use App\Models\Panen;
use App\Models\Kematian;
use App\Models\KualitasAir;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function admin()
    {
        // Total kolam
        $totalKolam = Kolam::count();

        // Daftar kolam
        $kolams = Kolam::select('id', 'nama', 'jumlah_ikan')->get();

        // Total hasil panen hari ini
        $totalHasilPanen = Panen::whereDate('tanggal_panen', today())->sum('berat_total');

        // Ambil panen terbaru per kolam
        $panenTerbaru = Kolam::with(['panen' => function ($query) {
            $query->orderBy('tanggal_panen', 'desc')->limit(1);
        }])->get();

        // Data kualitas air selama 7 hari terakhir per kolam
        // Data kualitas air selama 7 hari terakhir per kolam
        $dataKualitasAir = [];
        foreach ($kolams as $kolam) {
            $data = KualitasAir::where('kolam_id', $kolam->id)
                ->whereBetween('tanggal_pengukuran', [now()->startOfWeek(), now()->endOfWeek()])
                ->orderBy('tanggal_pengukuran')
                ->get()
                ->map(function ($item) {
                    $item->tanggal = \Carbon\Carbon::parse($item->tanggal_pengukuran)->format('Y-m-d');
                    return $item;
                });

            $dataKualitasAir[$kolam->id] = [
                'nama' => $kolam->nama,
                'data' => $data
            ];
        }

        // Data mortalitas hari ini, dikelompokkan per kolam dan penyebab
        $dataMortalitas = Kematian::with('kolam')
            ->selectRaw('kolam_id, penyebab, COUNT(*) as jumlah, DATE(tanggal_kematian) as tanggal_kematian')
            ->whereDate('tanggal_kematian', today())
            ->groupBy('kolam_id', 'penyebab', DB::raw('DATE(tanggal_kematian)'))
            ->get()
            ->groupBy(['kolam_id', 'penyebab']);

        // Top 5 penyebab kematian hari ini
        $penyebabKematian = Kematian::selectRaw('penyebab, COUNT(*) as total')
            ->whereDate('tanggal_kematian', today())
            ->groupBy('penyebab')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('partials.adminDashboard', [
            'totalKolam' => $totalKolam,
            'kolams' => $kolams,
            'totalHasilPanen' => $totalHasilPanen,
            'panenTerbaru' => $panenTerbaru,
            'dataKualitasAir' => $dataKualitasAir,
            'dataMortalitas' => $dataMortalitas,
            'penyebabKematian' => $penyebabKematian,
            'title' => 'Dashboard Admin',
        ]);
    }

    public function petugasKolam()
    {
        return view('partials.petugasKolamDashboard');
    }

    public function manajer()
    {
        return view('partials.manajerDashboard');
    }
}
