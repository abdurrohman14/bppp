@extends('layouts.admin.main')

@section('content')
<h3>Laporan {{ ucfirst($jenis) }} - {{ $bulan }}/{{ $tahun }}</h3>

<form method="GET" action="{{ route('index.admin.laporan') }}" class="mb-3">
    <select name="jenis">
        <option value="bulanan" {{ $jenis == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
        <option value="tahunan" {{ $jenis == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
    </select>

    @if($jenis == 'bulanan')
    <input type="month" name="tahun_bulan" value="{{ $tahun . '-' . $bulan }}">
    @else
    <input type="number" name="tahun" value="{{ $tahun }}" min="2000" max="{{ date('Y') }}">
    @endif

    <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">
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

<a href="{{ route('generate.admin.laporan', request()->query()) }}" target="_blank">Cetak PDF</a>
@endsection
