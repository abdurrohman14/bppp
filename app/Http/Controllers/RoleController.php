<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Kolam;
use App\Models\Kematian;
use App\Models\KualitasAir;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function admin()
    {
        // total kolam
        $totalKolam = Kolam::count();

        // total jumlah ikan per kolam
        $kolams = Kolam::select('id', 'nama', 'jumlah_ikan')->get();

        // total hasil panen terbaru (ambil 1 bulan terakhir)
        $totalHasilPanen = Kolam::with(['panen' => function ($query) {
            $query->where('tanggal_panen', '>=', now()->subMonth());
        }])->get()->sum(function ($kolam) {
            return $kolam->panen->sum('jumlah_ikan');
        });

        // ambil panen terbaru
        $panenTerbaru = Kolam::with(['panen' => function ($query) {
            $query->orderBy('tanggal_panen', 'desc')->first();
        }])->get();

        // data kualitas air untuk chart
        $dataKualitasAir = [];
        foreach ($kolams as $kolam) {
            $waterQualityData[$kolam->id] = [
                'nama' => $kolam->nama,
                'data' => KualitasAir::where('kolam_id', $kolam->id)
                    ->where('tanggal_pengukuran', '>=', now()->subDays(7))
                    ->orderBy('tanggal_pengukuran')
                    ->get()
            ];
        }

        // data mortalitas 1 bulan terakhir
        $dataMortalitas = Kematian::with('kolam')
                        ->selectRaw('kolam_id, penyebab, COUNT(*) as jumlah, DATE(tanggal_kematian) as tanggal_kematian')
                        ->where('tanggal_kematian', '>=', now()->subMonth())
                        ->groupBy('kolam_id', 'penyebab', DB::raw('DATE(tanggal_kematian)'))
                        ->get()
                        ->groupBy(['kolam_id', 'penyebab']);

         $penyebabKematian = Kematian::selectRaw('penyebab, COUNT(*) as total')
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
