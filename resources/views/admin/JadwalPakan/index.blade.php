@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3">
                <a href="{{ route('jadwal.pakan.create') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Spesies</th>
                        <th>Jam Pakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalPakan as $key => $pakan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pakan->spesies->jenis_ikan }}</td>
                            <td>{{ $pakan->jadwal_pakan }}</td>
                            <td>
                                <a href="{{ route('jadwal.pakan.edit', $pakan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jadwal.pakan.destroy', $pakan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
