@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold">Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="mb-3">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('pakan.Keluar.create') }}" class="text-decoration-none text-white">Tambah</a>
                </button>
            </div>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th class="text-start">Kolam</th>
                            <th class="text-start">Jenis Ikan</th>
                            <th class="text-start">Jenis Pakan</th>
                            <th class="text-start">Tanggal Keluar</th>
                            <th class="text-start">Jumlah Keluar</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakanKeluar as $item)
                        <tr>
                            <td class="text-start">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ optional($item->kolam)->nama ?? '-' }}</td>
                            <td class="text-start">{{ optional($item->spesies)->jenis_ikan ?? '-' }}</td>
                            <td class="text-start">{{ optional($item->pakan)->jenis_pakan ?? '-' }}</td>
                            <td class="text-start">{{ $item->tanggal_keluar }}</td>
                            <td class="text-start">{{ $item->jumlah_keluar }}</td>
                            <td style="padding-left: 12px;">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('pakan.Keluar.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                    <form action="{{ route('pakan.Keluar.destroy', $item->id) }}" method="POST" style="width: 80px;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
