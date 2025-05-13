@extends('partials.admin.main')
@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="mb-0" style="color: #003049;">Data Panen</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{ route('create.panen') }}" class="btn btn-primary btn-sm">Tambah</a>
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kolam</th>
                            <th>Jenis Ikan</th>
                            <th>Tanggal Panen</th>
                            <th>Berat Total (kg)</th>
                            <th>Harga per kg (Rp)</th>
                            <th>Tujuan Distribusi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($panen as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->kolam->nama ?? '-' }}</td>
                                <td>{{ $item->spesies->jenis_ikan ?? '-' }}</td>
                                <td>{{ $item->tanggal_panen }}</td>
                                <td>{{ $item->berat_total }}</td>
                                <td>{{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                                <td>{{ $item->tujuan_distribusi }}</td>
                                <td>
                                    <a href="{{ route('edit.panen', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('delete.panen', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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
