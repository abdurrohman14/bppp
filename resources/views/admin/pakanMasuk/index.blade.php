@extends('partials.admin.main')
@section('content')

<div class="content">
    <div class="table-container">
        <a href="{{ route('pakan.masuk.create') }}" class="btn btn-primary mb-3 text-white">+ Tambah</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kolam</th>
                    <th>Jenis Pakan</th>
                    <th>Tanggal Masuk</th>
                    <th>Jumlah Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pakanMasuk as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->kolam->nama }}</td>
                        <td>{{ $item->pakan->jenis_pakan }}</td>
                        <td>{{ $item->tanggal_masuk }}</td>
                        <td>{{ $item->jumlah_masuk }}</td>
                        <td>
                            <a href="{{ route('edit.pakan.masuk', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('delete.pakan.masuk', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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

@endsection
