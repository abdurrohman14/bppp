@extends('partials.admin.main')
@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Tambah Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pakan.Keluar.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Kolam</label>
                    <select class="form-select" id="kolam_id" name="kolam_id" required>
                        <option value="">-- Pilih Kolam --</option>
                        @foreach($kolam as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" id="spesies_id" name="spesies_id" required>
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach($spesies as $sps)
                            <option value="{{ $sps->id }}">{{ $sps->jenis_ikan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pakan_id" class="form-label">Pakan</label>
                    <select class="form-select" id="pakan_id" name="pakan_id" required>
                        <option value="">-- Pilih Pakan --</option>
                        @foreach($pakan as $pkt)
                            <option value="{{ $pkt->id }}">{{ $pkt->jenis_pakan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                    <input type="number" class="form-control" name="jumlah_keluar" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.pakan.Keluar') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
