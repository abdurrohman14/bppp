@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Manajemen Kematian</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm">
                        <a href="{{ route('create.petugas.kematian') }}" class="text-decoration-none text-white">Tambah Kematian</a>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
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
                            @foreach ($kematian as $key => $kmt)
                                <tr>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $kmt->kolam->nama }}</td>
                                    <td class="text-start">{{ $kmt->spesies->jenis_ikan }}</td>
                                    <td class="text-start">{{ $kmt->tanggal_kematian }}</td>
                                    <td class="text-start">{{ $kmt->jumlah_mati }}</td>
                                    <td class="text-start">{{ $kmt->penyebab }}</td>
                                    <td style="padding-left: 12px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit.petugas.kematian', $kmt->id) }}" 
                                               class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                            <form action="{{ route('delete.petugas.kematian', $kmt->id) }}" method="POST" style="width: 80px;"
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
