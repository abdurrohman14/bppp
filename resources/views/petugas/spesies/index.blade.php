@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Spesies</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.petugas.spesies') }}" class="text-decoration-none text-white">Tambah</a>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-start" style="width: 5%;">NO</th>
                                <th class="text-start">Jenis Ikan</th>
                                <th class="text-start">Deskripsi</th>
                                <th class="text-start" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spesies as $key => $sps)
                                <tr>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $sps->jenis_ikan }}</td>
                                    <td class="text-start">{{ $sps->deskripsi }}</td>
                                    <td style="padding-left: 12px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit.petugas.spesies', $sps->id) }}"
                                                class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                            <form action="{{ route('delete.petugas.spesies', $sps->id) }}" method="POST" style="width: 80px;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
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
