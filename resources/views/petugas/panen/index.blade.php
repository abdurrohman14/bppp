@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 500px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Data Panen</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('create.petugas.panen') }}" class="text-decoration-none text-white">Tambah</a>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th class="text-start">Kolam</th>
                            <th class="text-start">Jenis Ikan</th>
                            <th class="text-start">Tanggal Panen</th>
                            <th class="text-start">Berat Total (kg)</th>
                            <th class="text-start">Harga per kg (Rp)</th>
                            <th class="text-start">Jumlah Ikan</th>
                            <th class="text-start">Tujuan Distribusi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($panen as $index => $item)
                            <tr>
                                <td class="text-start">{{ $index + 1 }}</td>
                                <td class="text-start">{{ $item->kolam->nama ?? '-' }}</td>
                                <td class="text-start">{{ $item->spesies->jenis_ikan ?? '-' }}</td>
                                <td class="text-start">{{ $item->tanggal_panen }}</td>
                                <td class="text-start">{{ $item->berat_total }}</td>
                                <td class="text-start">{{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                                <td class="text-start">{{ $item->jumlah_ikan }}</td>
                                <td class="text-start">{{ $item->tujuan_distribusi }}</td>
                                <td style="padding-left: 12px;">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('edit.petugas.panen', $item->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                        <form action="{{ route('delete.petugas.panen', $item->id) }}" method="POST" style="width: 80px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
