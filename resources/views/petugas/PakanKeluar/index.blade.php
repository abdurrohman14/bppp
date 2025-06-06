@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('create.petugas.PakanKeluar') }}" class="text-decoration-none text-white">Tambah Data</a>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
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
                        @forelse($pakanKeluar as $item)
                        <tr>
                            <td class="text-start">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ optional($item->kolam)->nama ?? '-' }}</td>
                            <td class="text-start">{{ optional($item->spesies)->jenis_ikan ?? '-' }}</td>
                            <td class="text-start">{{ optional($item->pakan)->jenis_pakan ?? '-' }}</td>
                            <td class="text-start">{{ $item->tanggal_keluar }}</td>
                            <td class="text-start">{{ $item->jumlah_keluar }}</td>
                            <td style="padding-left: 12px;">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('edit.petugas.PakanKeluar', $item->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                    <form action="{{ route('destroy.petugas.PakanKeluar', $item->id) }}" method="POST" style="width: 80px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- Jika ingin tampilkan pesan kosong, bisa aktifkan baris ini --}}
                        {{-- <tr><td colspan="7" class="text-center">Tidak ada data</td></tr> --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
