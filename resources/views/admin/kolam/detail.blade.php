@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">{{ $title }}</h1>
            <a href="{{ route('index.kolam') }}" class="btn btn-outline-secondary">← Kembali</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Kolam</h5>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Nama Kolam</h6>
                        <p class="text-muted">{{ $kolam->nama }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Budaya</h6>
                        <p class="text-muted">{{ $kolam->budaya }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Status</h6>
                        <p class="text-muted">{{ $kolam->status }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Jumlah Ikan</h6>
                        <p class="text-muted">{{ $kolam->jumlah_ikan ?? 'Kosong' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Ukuran Kolam</h6>
                        <p class="text-muted">{{ $kolam->ukuran_kolam }}</p>
                    </div>
                </div>

                <hr>

                <div class="mt-4">
                    <h6 class="fw-bold">QR Code</h6>
                    @if ($kolam->qr_code && file_exists(public_path('storage/' . $kolam->qr_code)))
                        <div class="border rounded p-3 text-center">
                            {!! file_get_contents(public_path('storage/' . $kolam->qr_code)) !!}
                        </div>
                    @else
                        <p class="text-muted">QR Code belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
