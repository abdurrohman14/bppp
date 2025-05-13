@extends('partials.admin.main')
@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Manajemen Kolam</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button class="btn btn-primary btn-sm"><a href="{{ route('create.petugas.kolam') }}"
                            class="text-decoration-none text-white">Tambah</a></button>
                    <table id="example1" class="table table-bordered table-striped">
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
                                        <button class="btn btn-primary btn-sm"><a href="{{ route('edit.petugas.kolam', $klm->id) }}"
                                                class="text-decoration-none text-white">Edit</a></button>
                                        <form action="{{ route('delete.petugas.kolam', $klm->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
