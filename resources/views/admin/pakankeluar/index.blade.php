@extends('partials.admin.main')
@section('content')

<div class="content">
    <div class="table-container">
        <a href="{{ route('pakan.keluar.create') }}" class="btn btn-primary mb-3 text-white">+ Tambah</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kolam</th>
                    <th>Jenis Ikan</th>
                    <th>Jenis Pakan</th>
                    <th>Tanggal Keluar</th>
                    <th>Jumlah Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pakanKeluar as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->kolam->nama }}</td>
                        <td>{{ $item->spesies->jenis_ikan }}</td>
                        <td>{{ $item->pakan->jenis_pakan }}</td>
                        <td>{{ $item->tanggal_keluar }}</td>
                        <td>{{ $item->jumlah_keluar }}</td>
                        <td>
                            <a href="{{ route('edit.pakan_keluar', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('delete.pakan_keluar', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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
