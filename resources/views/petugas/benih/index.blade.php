@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Penebaran Benih</h5>
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
                <a href="{{ route('create.petugas.benih') }}" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-start">NO</th>
                            <th class="text-start">Nama Kolam</th>
                            <th class="text-start">Jenis Ikan</th>
                            <th class="text-start">Ukuran Benih (CM)</th>
                            <th class="text-start">Asal Benih</th>
                            <th class="text-start">Tanggal Tebar</th>
                            <th class="text-start">Jumlah Benih</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penebaranBenih as $key => $bnh)
                            <tr>
                                <td class="text-start">{{ $key + 1 }}</td>
                                <td class="text-start">{{ $bnh->kolam->nama }}</td>
                                <td class="text-start">{{ $bnh->spesies->jenis_ikan }}</td>
                                <td class="text-start">{{ $bnh->ukuran }}</td>
                                <td class="text-start">{{ $bnh->asal_benih }}</td>
                                <td class="text-start">{{ $bnh->tanggal_tebar }}</td>
                                <td class="text-start">{{ $bnh->jumlah_benih }}</td>
                                <td style="padding-left: 12px;">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('edit.petugas.benih', $bnh->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                        <form action="{{ route('delete.petugas.benih', $bnh->id) }}" method="POST" style="width: 80px;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
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
