@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Data Pakan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.petugas.JenisPakan') }}" class="text-decoration-none text-white">Tambah</a>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th class="text-start">No</th>
                                <th class="text-start">Jenis Pakan</th>
                                <th class="text-start">Asal Pakan</th>
                                {{-- <th class="text-start">Ukuran Pakan</th> --}}
                                <th class="text-start">Jumlah Pakan</th>
                                <th class="text-start">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakan as $index => $item)
                                <tr>
                                    <td class="text-start">{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $item->jenis_pakan }}</td>
                                    <td class="text-start">{{ $item->asal_pakan }}</td>
                                    {{-- <td class="text-start">{{ $item->ukuran_pakan }}</td> --}}
                                    <td class="text-start">{{ $item->jumlah_pakan }}</td>
                                    <td style="padding-left: 12px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit.petugas.JenisPakan', $item->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                            <form action="{{ route('destroy.petugas.JenisPakan', $item->id) }}" method="POST" style="width: 80px;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
