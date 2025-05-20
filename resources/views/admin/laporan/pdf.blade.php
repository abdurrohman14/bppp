<!DOCTYPE html>
<html>

<head>
    <title>Laporan {{ ucfirst($jenis) }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Balai Pelatihan dan Penyuluhan Perikanan (BPPP) Banyuwangi</h2>
    <h3 style="text-align: center;">
        Laporan {{ ucfirst($jenis) }} -
        {{ $jenis == 'bulanan' ? $bulan . '/' . $tahun : $tahun }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kolam</th>
                <th>Total Penebaran (ekor)</th>
                <th>Rata-rata Suhu (°C)</th>
                <th>Rata-rata pH</th>
                <th>Rata-rata DO (mg/L)</th>
                <th>Total Mortalitas (ekor)</th>
                <th>Total Panen (kg)</th>
                <th>Total Nilai Panen (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama_kolam }}</td>
                    <td>{{ $item->total_penebaran }}</td>
                    <td>{{ number_format($item->rata_rata_suhu, 2) }}</td>
                    <td>{{ number_format($item->rata_rata_ph, 2) }}</td>
                    <td>{{ number_format($item->rata_rata_do, 2) }}</td>
                    <td>{{ $item->total_mortalitas }}</td>
                    <td>{{ number_format($item->total_panen, 2) }}</td>
                    <td>Rp {{ number_format($item->total_nilai_panen, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
