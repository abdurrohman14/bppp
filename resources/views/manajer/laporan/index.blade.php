@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Laporan {{ ucfirst($jenis) }} - {{ $jenis == 'bulanan' ? "$bulan/$tahun" : $tahun }}</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('index.lprn') }}" class="mb-4 row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="jenis" class="form-label">Jenis Laporan</label>
                        <select name="jenis" id="jenis" class="form-select">
                            <option value="bulanan" {{ $jenis == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ $jenis == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        @if ($jenis == 'bulanan')
                            <label for="tahun_bulan" class="form-label">Bulan/Tahun</label>
                            <input type="month" name="tahun_bulan" id="tahun_bulan" class="form-control"
                                value="{{ $tahun }}-{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}">
                        @else
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control"
                                value="{{ $tahun }}" min="2000" max="{{ date('Y') }}">
                        @endif
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
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
                                        <td class="text-end">{{ number_format($item->total_penebaran, 0) }}</td>
                                        <td class="text-end">{{ number_format($item->rata_rata_suhu, 2) }}</td>
                                        <td class="text-end">{{ number_format($item->rata_rata_ph, 2) }}</td>
                                        <td class="text-end">{{ number_format($item->rata_rata_do, 2) }}</td>
                                        <td class="text-end">{{ number_format($item->total_mortalitas, 0) }}</td>
                                        <td class="text-end">{{ number_format($item->total_panen, 2) }}</td>
                                        <td class="text-end">Rp {{ number_format($item->total_nilai_panen, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="2">Total</td>
                                    <td class="text-end">{{ number_format($laporan->sum('total_penebaran'), 0) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">{{ number_format($laporan->sum('total_mortalitas'), 0) }}</td>
                                    <td class="text-end">{{ number_format($laporan->sum('total_panen'), 2) }}</td>
                                    <td class="text-end">Rp
                                        {{ number_format($laporan->sum('total_nilai_panen'), 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('generate.lprn', request()->query()) }}" target="_blank"
                                class="btn btn-primary px-4">
                                <i class="fas fa-file-pdf me-2"></i>Cetak PDF
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Tidak ada data laporan untuk periode yang dipilih.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
