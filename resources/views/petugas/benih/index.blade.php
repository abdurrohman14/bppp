@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="mb-0">Penebaran Benih</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button class="btn btn-success btn-sm">
                        <a href="{{ route('create.petugas.benih') }}" class="text-decoration-none text-white">Tambah</a>
                    </button>
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kolam</th>
                                <th>Jenis Ikan</th>
                                <th>Ukuran Benih (CM)</th>
                                <th>Asal Benih</th>
                                <th>Tanggal Tebar</th>
                                <th>Jumlah Benih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penebaranBenih as $key => $bnh)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bnh->kolam->nama }}</td>
                                    <td>{{ $bnh->spesies->jenis_ikan }}</td>
                                    <td>{{ $bnh->ukuran }}</td>
                                    <td>{{ $bnh->asal_benih }}</td>
                                    <td>{{ $bnh->tanggal_tebar }}</td>
                                    <td>{{ $bnh->jumlah_benih }}</td>
                                    <td class="d-flex flex-column gap-1">
                                        <a href="{{ route('edit.petugas.benih', $bnh->id) }}"
                                            class="btn btn-primary text-white mb-1">Edit</a>
                                        <form action="{{ route('delete.petugas.benih', $bnh->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
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
