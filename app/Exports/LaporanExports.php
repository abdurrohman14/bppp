<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExports implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $laporan;
    protected $jenis;
    protected $tahun;
    protected $bulan;

    public function __construct($laporan, $jenis, $tahun, $bulan = null)
    {
        $this->laporan = $laporan;
        $this->jenis = $jenis;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return $this->laporan;
    }

    public function headings(): array
    {
        return [
            'Nama Kolam',
            'Total Penebaran (Benih)',
            'Rata-rata Suhu (°C)',
            'Rata-rata pH',
            'Rata-rata DO (mg/L)',
            'Total Mortalitas',
            'Total Pakan Keluar (kg)',
            'Total Panen (kg)',
            'Total Nilai Panen (Rp)'
        ];
    }

    public function map($kolam): array
    {
        return [
            $kolam->nama_kolam,
            $kolam->total_penebaran,
            $kolam->rata_rata_suhu,
            $kolam->rata_rata_ph,
            $kolam->rata_rata_do,
            $kolam->total_mortalitas,
            $kolam->jumlah_keluar,
            $kolam->total_panen,
            number_format($kolam->total_nilai_panen, 2)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A:I' => ['alignment' => ['horizontal' => 'center']],
            'I' => ['alignment' => ['horizontal' => 'right']]
        ];
    }
}
