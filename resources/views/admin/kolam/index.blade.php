@extends('partials.admin.main')
@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3"><a href="{{ route('create.kolam') }}"
                    class="text-decoration-none text-white">Tambah</a></button>
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
                            <td>
                                <button class="btn btn-primary"><a href="{{ route('edit.kolam', $klm->id) }}"
                                        class="text-decoration-none text-white">Edit</a></button>
                                <form action="{{ route('delete.kolam', $klm->id) }}" method="POST"
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
