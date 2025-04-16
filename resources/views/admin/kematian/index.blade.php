@extends('partials.admin.main')

@section('content')
<div class="content">
    <div class="table-container">
        <a href="{{ route('create.kematian') }}" class="btn btn-primary mb-3 text-white">+ Tambah</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kolam</th>
                    <th>Jenis Ikan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Penyebab</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kematian as $key => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->kolam->nama }}</td>
                        <td>{{ $item->spesies->jenis_ikan }}</td>
                        <td>{{ $item->tanggal_mati }}</td>
                        <td>{{ $item->jumlah_kematian }}</td>
                        <td>{{ $item->penyebab }}</td>
                        <td>
                            <a href="{{ route('edit.kematian', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('delete.kematian', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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
