@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-warning mb-3">
                <a href="{{ route('create.petugas.kematian') }}" class="text-decoration-none text-white">Tambah Kematian</a>
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Kolam</th>
                        <th>Jenis Ikan</th>
                        <th>Tanggal Kematian</th>
                        <th>Jumlah Kematian</th>
                        <th>Penyebab</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kematian as $key => $kmt)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kmt->kolam->nama }}</td>
                            <td>{{ $kmt->spesies->jenis_ikan }}</td>
                            <td>{{ $kmt->tanggal_kematian }}</td>
                            <td>{{ $kmt->jumlah_mati }}</td>
                            <td>{{ $kmt->penyebab }}</td>
                            <td class="d-flex flex-column gap-1">
                                <a href="{{ route('edit.petugas.kematian', $kmt->id) }}" class="btn btn-warning text-white mb-1">Edit</a>
                                <form action="{{ route('delete.petugas.kematian', $kmt->id) }}" method="POST"
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
