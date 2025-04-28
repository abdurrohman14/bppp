@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3">
                <a href="{{ route('pakan.create') }}" class="text-decoration-none text-white">Tambah Pakan</a>
            </button>
            <table class="table table-bordered">
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
                            <td class="d-flex flex-column gap-1">
                                <a href="{{ route('pakan.edit', $item->id) }}" class="btn btn-primary text-white mb-1">Edit</a>
                                <form action="{{ route('pakan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
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
