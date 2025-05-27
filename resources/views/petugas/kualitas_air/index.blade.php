@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0" style="min-height: 550px;">
            <div class="card-header">
                <h5 class="fw-bold" style="color: #003049;">Manajemen Kualitas Air</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('create.petugas.kualitasair') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-start" style="width: 50px;">NO</th>
                                <th class="text-start">Nama Kolam</th>
                                <th class="text-start">Tanggal Pengukuran</th>
                                <th class="text-start">pH</th>
                                <th class="text-start">Temperatur (°C)</th>
                                <th class="text-start">Oksigen Terlarut (mg/L)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($air as $key => $kualitas)
                                <tr>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $kualitas->kolam->nama }}</td>
                                    <td class="text-start">{{ $kualitas->tanggal_pengukuran }}</td>
                                    <td class="text-start">{{ $kualitas->ph }}</td>
                                    <td class="text-start">{{ $kualitas->temperatur }}</td>
                                    <td class="text-start">{{ $kualitas->oksigen_terlarut }}</td>
                                    <td style="padding-left: 12px; min-width: 170px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit.petugas.kualitasair', $kualitas->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Edit</a>
                                            <form action="{{ route('delete.petugas.kualitasair', $kualitas->id) }}" method="POST" style="width: 80px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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
