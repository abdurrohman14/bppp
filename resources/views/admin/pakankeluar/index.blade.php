@extends('partials.admin.main')

@section('content')
<div class="content">
    <div class="card shadow">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pakan Keluar</h5>
            <a href="{{ route('pakan.Keluar.create') }}" class="btn btn-light btn-sm">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
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
                        @forelse($pakanKeluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($item->kolam)->nama ?? '-' }}</td>
                            <td>{{ optional($item->spesies)->jenis_ikan ?? '-' }}</td>
                            <td>{{ optional($item->pakan)->pakan ?? '-' }}</td>
                            <td>{{ $item->tanggal_keluar }}</td>
                            <td>{{ $item->jumlah_keluar }}</td>
                            <td>
                                <a href="{{ route('pakan.Keluar.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pakan.Keluar.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                </form>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
