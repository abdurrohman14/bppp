@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Manajemen Kolam</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.kolam') }}" class="text-decoration-none text-white">Tambah</a>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-start">NO</th>
                                <th>Nama</th>
                                <th>Budaya</th>
                                <th>Status</th>
                                <th class="text-start">Jumlah Ikan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kolam as $key => $klm)
                                <tr>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td>{{ $klm->nama }}</td>
                                    <td>{{ $klm->budaya }}</td>
                                    <td>{{ $klm->status }}</td>
                                    <td class="text-start">{{ $klm->jumlah_ikan }}</td>
                                    <td style="padding-left: 12px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit.kolam', $klm->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                            <form action="{{ route('delete.kolam', $klm->id) }}" method="POST" style="width: 80px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </div>
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
