@extends('partials.admin.main')
@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
       <div class="card shadow border-0" style="min-height: 550px;">
        <div class="card-header">
            <h5 class="fw-bold" style="color: #003049;">Manajemen Benih</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <button class="btn btn-primary btn-sm">
                <a href="{{ route('create.benih') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Kolam</th>
                        <th>Jenis Ikan</th>
                        <th>Ukuran Benih (CM)</th>
                        <th>Asal Benih</th>
                        <th>Tanggal Tebar</th>
                        <th>Jumlah Benih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penebaranBenih as $key => $bnh)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $bnh->kolam->nama }}</td>
                            <td>{{ $bnh->spesies->jenis_ikan }}</td>
                            <td>{{ $bnh->ukuran }}</td>
                            <td>{{ $bnh->asal_benih }}</td>
                            <td>{{ $bnh->tanggal_tebar }}</td>
                            <td>{{ $bnh->jumlah_benih }}</td>
                            <td class="d-flex flex-column gap-1">
                                <a href="{{ route('edit.benih', $bnh->id) }}" class="btn btn-primary btn-sm text-white mb-1">Edit</a>
                                <form action="{{ route('delete.benih', $bnh->id) }}" method="POST"
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
