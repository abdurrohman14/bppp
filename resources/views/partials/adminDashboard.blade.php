@extends('partials.admin.main')
@section('content')
    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Statistik Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">Total Kolam</h5>
                                <h2 class="mb-0">{{ $totalKolam }}</h2>
                            </div>
                            <i class="fas fa-water fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">Total Panen (Hari ini)</h5>
                                <h2 class="mb-0">{{ $totalHasilPanen }} kg</h2>
                            </div>
                            <i class="fas fa-fish fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">Total Ikan</h5>
                                <h2 class="mb-0">{{ $kolams->sum('jumlah_ikan') }} ekor</h2>
                            </div>
                            <i class="fas fa-fish fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Water Quality Chart Section -->
        <div class="card shadow mt-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Kualitas Air (Hari ini)</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="waterQualityTabs" role="tablist">
                    @foreach ($dataKualitasAir as $kolamId => $data)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $kolamId }}"
                                data-bs-toggle="tab" data-bs-target="#chart-{{ $kolamId }}" type="button"
                                role="tab">
                                {{ $data['nama'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content py-3" id="waterQualityTabContent">
                    @foreach ($dataKualitasAir as $kolamId => $data)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="chart-{{ $kolamId }}"
                            role="tabpanel">
                            <canvas id="waterChart-{{ $kolamId }}" height="100"></canvas>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Mortality Chart Section -->
        <div class="card shadow mt-4">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tren Mortalitas (Hari ini)</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="mortalityFilter"
                            data-bs-toggle="dropdown">
                            Filter Kolam
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-kolam="all">Semua Kolam</a></li>
                            @foreach ($kolams as $kolam)
                                <li><a class="dropdown-item" href="#"
                                        data-kolam="{{ $kolam->id }}">{{ $kolam->nama }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <canvas id="mortalityTrendChart" height="200"></canvas>
                    </div>
                    <div class="col-md-4">
                        <h6>Penyebab Utama Kematian</h6>
                        <div class="list-group">
                            @foreach ($penyebabKematian as $cause)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $cause->penyebab }}
                                    <span class="badge bg-danger rounded-pill">{{ $cause->total }} kasus</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row  mt-4">
            <!-- Daftar Kolam -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Jumlah Ikan per Kolam</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">Nama Kolam</th>
                                        <th class="border-0 text-end">Jumlah Ikan</th>
                                        <th class="border-0" style="width: 40%">Kapasitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kolams as $kolam)
                                        <tr>
                                            <td>{{ $kolam->nama }}</td>
                                            <td class="text-end">{{ number_format($kolam->jumlah_ikan) }} ekor</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    @php
                                                        $percentage = min(100, ($kolam->jumlah_ikan / 2500) * 100);
                                                        $color =
                                                            $percentage > 80
                                                                ? 'bg-danger'
                                                                : ($percentage > 50
                                                                    ? 'bg-warning'
                                                                    : 'bg-success');
                                                    @endphp
                                                    <div class="progress-bar {{ $color }}" role="progressbar"
                                                        style="width: {{ $percentage }}%"
                                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ round($percentage) }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panen Terbaru -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Panen Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if ($panenTerbaru->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($panenTerbaru as $panen)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $panen->kolam->nama ?? 'Kolam tidak ada' }}</h6>
                                                <small class="text-muted">
                                                    @if ($panen->tanggal_panen)
                                                        {{ $panen->tanggal_panen->format('d M Y') }}
                                                    @else
                                                        Tanggal tidak tersedia
                                                    @endif
                                                </small>
                                            </div>
                                            <span class="badge bg-success rounded-pill fs-6">{{ $panen->jumlah_panen }}
                                                kg</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-fish fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada data panen terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        {{-- <div class="card shadow mt-3">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Statistik Panen</h5>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="100"></canvas>
            </div>
        </div> --}}
    </main>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Water Quality Charts
    @foreach($dataKualitasAir as $kolamId => $data)
    const ctxWater{{ $kolamId }} = document.getElementById('waterChart-{{ $kolamId }}');
    new Chart(ctxWater{{ $kolamId }}, {
        type: 'line',
        data: {
            labels: {!! json_encode($data['data']->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))) !!},
            datasets: [
                {
                    label: 'pH',
                    data: {!! json_encode($data['data']->pluck('ph')) !!},
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.4
                },
                {
                    label: 'Suhu (°C)',
                    data: {!! json_encode($data['data']->pluck('suhu')) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.4
                },
                {
                    label: 'DO (mg/L)',
                    data: {!! json_encode($data['data']->pluck('do')) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
    @endforeach

    // Mortality Trend Chart
    const mortalityData = {!! json_encode($dataMortalitas) !!};
    const ctxMortality = document.getElementById('mortalityTrendChart');
    const mortalityChart = new Chart(ctxMortality, {
        type: 'bar',
        data: getMortalityChartData('all'),
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        afterBody: function(context) {
                            const kolamId = context[0].dataset.kolamId;
                            const date = context[0].label;
                            const cause = context[0].dataset.label;

                            const details = mortalityData[kolamId]?.[cause]?.find(item =>
                                item.tanggal === date
                            );

                            return details ? `Penyebab: ${cause}\nJumlah: ${details.jumlah}` : '';
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
            }
        }
    });

    // Filter by kolam
    document.querySelectorAll('[data-kolam]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const kolamId = this.getAttribute('data-kolam');
            mortalityChart.data = getMortalityChartData(kolamId);
            mortalityChart.update();
        });
    });

    function getMortalityChartData(kolamId) {
        const filteredData = kolamId === 'all'
            ? mortalityData
            : { [kolamId]: mortalityData[kolamId] || {} };

        // Get all unique dates
        const dates = new Set();
        Object.values(filteredData).forEach(causes => {
            Object.values(causes).forEach(records => {
                records.forEach(record => dates.add(record.tanggal));
            });
        });
        const sortedDates = Array.from(dates).sort();

        // Get all causes
        const causes = new Set();
        Object.values(filteredData).forEach(causesData => {
            Object.keys(causesData).forEach(cause => causes.add(cause));
        });

        // Prepare datasets
        const datasets = [];
        causes.forEach(cause => {
            Object.keys(filteredData).forEach(kId => {
                datasets.push({
                    label: cause,
                    kolamId: kId,
                    data: sortedDates.map(date => {
                        const record = filteredData[kId]?.[cause]?.find(r => r.tanggal === date);
                        return record ? record.jumlah : 0;
                    }),
                    backgroundColor: getRandomColor(),
                });
            });
        });

        return {
            labels: sortedDates.map(date => new Date(date).toLocaleDateString()),
            datasets: datasets
        };
    }

    function getRandomColor() {
        return `hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`;
    }
</script>
@endpush
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .progress {
            border-radius: 10px;
            background-color: #f0f0f0;
        }

        .list-group-item {
            border-left: 0;
            border-right: 0;
        }

        .list-group-item:first-child {
            border-top: 0;
        }

        .list-group-item:last-child {
            border-bottom: 0;
        }
    </style>
@endsection
