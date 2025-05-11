@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3">
                <a href="{{ route('create.petugas.spesies') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Jenis Ikan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spesies as $key => $sps)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sps->jenis_ikan }}</td>
                            <td>{{ $sps->deskripsi }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('edit.petugas.spesies', $sps->id) }}" class="btn btn-primary text-white">Edit</a>
                                <form action="{{ route('delete.petugas.spesies', $sps->id) }}" method="POST"
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
