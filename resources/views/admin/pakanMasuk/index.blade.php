@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Data Pakan Masuk</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('pakan.masuk.create') }}" class="text-decoration-none text-white">Tambah</a>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th class="text-start">Jenis Pakan</th>
                            <th class="text-start">Tanggal Masuk</th>
                            <th class="text-start">Jumlah Masuk</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakanMasuk as $key => $item)
                            <tr>
                                <td class="text-start">{{ $key + 1 }}</td>
                                <td class="text-start">{{ $item->pakan->jenis_pakan ?? 'Pakan Tidak Ditemukan' }}</td>
                                <td class="text-start">{{ $item->tanggal_masuk }}</td>
                                <td class="text-start">{{ $item->jumlah_masuk }}</td>
                                <td style="padding-left: 12px;">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('edit.pakan.masuk', $item->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                        <form action="{{ route('pakan.masuk.destroy', $item->id) }}" method="POST" style="width: 80px;" onsubmit="return confirm('Yakin hapus data?')">
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
