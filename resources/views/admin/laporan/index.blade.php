@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header ">
                <h5 class="mb-0">Laporan {{ ucfirst($jenis) }} - {{ $jenis == 'bulanan' ? "$bulan/$tahun" : $tahun }}</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('index.laporan') }}" class="mb-3">
                    <select name="jenis">
                        <option value="bulanan" {{ $jenis == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ $jenis == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    </select>

                    @if ($jenis == 'bulanan')
                        <input type="month" name="tahun_bulan"
                            value="{{ $tahun }}-{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}">
                    @else
                        <input type="number" name="tahun" value="{{ $tahun }}" min="2000"
                            max="{{ date('Y') }}">
                    @endif

                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </form>
                <div class="table-responsive">

                    @if (count($laporan) > 0)
                        <table class="table table-bordered table-striped" id="example1">
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

                        <a href="{{ route('generate.laporan', request()->query()) }}" target="_blank"
                            class="btn btn-primary">Cetak PDF</a>
                    @else
                        <p>Tidak ada data laporan untuk periode yang dipilih.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
