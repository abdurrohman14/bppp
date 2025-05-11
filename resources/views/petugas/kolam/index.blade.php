@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-success mb-3">
                <a href="{{ route('create.petugas.kolam') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Budaya</th>
                        <th>Status</th>
                        <th>Jumlah Ikan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kolam as $key => $klm)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $klm->nama }}</td>
                            <td>{{ $klm->budaya }}</td>
                            <td>{{ $klm->status }}</td>
                            <td>{{ $klm->jumlah_ikan }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('edit.petugas.kolam', $klm->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('delete.petugas.kolam', $klm->id) }}" method="POST"
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
@endsection
