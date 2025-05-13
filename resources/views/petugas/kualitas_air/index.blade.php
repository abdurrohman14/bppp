@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Kualitas Air</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('create.petugas.kualitasair') }}" class="btn btn-success mb-3">Tambah</a>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kolam</th>
                            <th>Tanggal Pengukuran</th>
                            <th>pH</th>
                            <th>Temperatur (°C)</th>
                            <th>Oksigen Terlarut (mg/L)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($air as $key => $kualitas)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kualitas->kolam->nama }}</td>
                                <td>{{ $kualitas->tanggal_pengukuran }}</td>
                                <td>{{ $kualitas->ph }}</td>
                                <td>{{ $kualitas->temperatur }}</td>
                                <td>{{ $kualitas->oksigen_terlarut }}</td>
                                <td>
                                    <a href="{{ route('edit.petugas.kualitasair', $kualitas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- Form Hapus -->
                                    <form action="{{ route('delete.petugas.kualitasair', $kualitas->id) }}" method="POST" style="display:inline;">
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
    </main>
@endsection
