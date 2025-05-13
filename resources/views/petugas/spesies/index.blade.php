@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="mb-0">Spesies</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.petugas.spesies') }}" class="text-decoration-none text-white">Tambah</a>
                    </button>
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Jenis Ikan</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spesies as $key => $sps)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sps->jenis_ikan }}</td>
                                    <td>{{ $sps->deskripsi }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('edit.petugas.spesies', $sps->id) }}"
                                            class="btn btn-primary btn-sm text-white">Edit</a>
                                        <form action="{{ route('delete.petugas.spesies', $sps->id) }}" method="POST"
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
