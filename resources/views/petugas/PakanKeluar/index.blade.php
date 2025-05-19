@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header" style="color: #003049;">
            <h5 class="mb-0">Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm">
                <a href="{{ route('create.petugas.PakanKeluar') }}" class="text-decoration-none text-white">Tambah Data</a>
            </button>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
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
                        @forelse($pakanKeluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($item->kolam)->nama ?? '-' }}</td>
                            <td>{{ optional($item->spesies)->jenis_ikan ?? '-' }}</td>
                            <td>{{ optional($item->pakan)->pakan ?? '-' }}</td>
                            <td>{{ $item->tanggal_keluar }}</td>
                            <td>{{ $item->jumlah_keluar }}</td>
                            <td>
                                <a href="{{ route('edit.petugas.PakanKeluar', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('destroy.petugas.PakanKeluar', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        {{-- <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr> --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
