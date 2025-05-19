@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0">
        <div class="card-header">
            <h5 class="mb-0">Data Pakan Masuk</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm">
                <a href="{{ route('create.petugas.PakanMasuk') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pakan</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakanMasuk as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->pakan->nama ?? 'Pakan Tidak Ditemukan' }}</td>
                                <td>{{ $item->tanggal_masuk }}</td>
                                <td>{{ $item->jumlah_masuk }}</td>
                                <td>
                                    <a href="{{ route('edit.petugas.PakanMasuk', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                    <form action="{{ route('destroy.petugas.PakanMasuk', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
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
