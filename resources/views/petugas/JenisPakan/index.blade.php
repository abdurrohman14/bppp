@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0">
        <div class="card-header">
            <h5 class="mb-0">Data Pakan</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('create.petugas.JenisPakan') }}" class="btn btn-primary btn-sm mb-3">Tambah Pakan</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pakan</th>
                            <th>Asal Pakan</th>
                            <th>Ukuran Pakan</th>
                            <th>Jumlah Pakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pakan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->pakan }}</td>
                                <td>{{ $item->asal_pakan }}</td>
                                <td>{{ $item->ukuran_pakan }}</td>
                                <td>{{ $item->jumlah_pakan }}</td>
                                <td>
                                    <a href="{{ route('edit.petugas.JenisPakan', $item->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                                    <form action="{{ route('destroy.petugas.JenisPakan', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
