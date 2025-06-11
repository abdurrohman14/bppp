@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Manajemen Mortalitas</h5>
        </div>
        <div class="card-body">

            {{-- Notifikasi --}}
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('create.petugas.kematian') }}" class="text-decoration-none text-white">Tambah Mortalitas</a>
                </button>
            </div>

            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-start">NO</th>
                            <th class="text-start">Nama Kolam</th>
                            <th class="text-start">Jenis Ikan</th>
                            <th class="text-start">Tanggal Kematian</th>
                            <th class="text-start">Jumlah Kematian</th>
                            <th class="text-start">Penyebab</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kematian as $key => $item)
                            <tr>
                                <td class="text-start">{{ $key + 1 }}</td>
                                <td class="text-start">{{ $item->kolam->nama }}</td>
                                <td class="text-start">{{ $item->spesies->jenis_ikan }}</td>
                                <td class="text-start">{{ $item->tanggal_kematian }}</td>
                                <td class="text-start">{{ $item->jumlah_mati }}</td>
                                <td class="text-start">{{ $item->penyebab }}</td>
                                <td style="padding-left: 12px;">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('edit.petugas.kematian', $item->id) }}" 
                                           class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                        <form action="{{ route('delete.petugas.kematian', $item->id) }}" method="POST" style="width: 80px;"
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
