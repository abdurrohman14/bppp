@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="mb-0">Kematian</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.petugas.kematian') }}" class="text-decoration-none text-white">Tambah
                            Kematian</a>
                    </button>
                    <table class="table table-bordered table-striped" id="example1">
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
                                        <a href="{{ route('edit.petugas.kematian', $kmt->id) }}"
                                            class="btn btn-warning text-white mb-1">Edit</a>
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
        </div>
    </main>
@endsection
