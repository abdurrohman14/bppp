@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="container mt-4">
            <h1>{{ $title }}</h1>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Nama Kolam: {{ $kolam->nama }}</h5>
                    <p><strong>Budaya:</strong> {{ $kolam->budaya }}</p>
                    <p><strong>Status:</strong> {{ $kolam->status }}</p>
                    <p><strong>Jumlah Ikan:</strong> {{ $kolam->jumlah_ikan ?? 'Kosong' }}</p>
                    <p><strong>Diameter Kolam:</strong> {{ $kolam->ukuran_kolam }}</p>

                    @if ($kolam->qr_code && file_exists(public_path('storage/' . $kolam->qr_code)))
                        <div class="mt-3">
                            <h6>QR Code</h6>
                            {!! file_get_contents(public_path('storage/' . $kolam->qr_code)) !!}
                        </div>
                    @else
                        <p class="text-muted">QR Code belum tersedia.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('index.kolam') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
