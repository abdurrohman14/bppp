@extends('partials.admin.main')
@section('content')
    <div class="content">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Form Manajemen Kolam</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.petugas.kolam', $kolam->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaKolam" class="form-label">Nama Kolam</label>
                        <input type="text" class="form-control" id="namaKolam" name="nama"
                            placeholder="Masukkan Nama Kolam" value="{{ $kolam->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="sistem" class="form-label">Sistem yang Digunakan</label>
                        <select class="form-select" id="sistem" name="budaya" required>
                            @foreach ($budaya as $key => $budayaKolam)
                                <option value="{{ $budayaKolam }}" {{ $kolam->budaya == $budayaKolam ? 'selected ' : '' }}>{{ $budayaKolam }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            @foreach ($status as $key => $statusKolam)
                                <option value="{{ $statusKolam }}" {{ $kolam->status == $statusKolam ? 'selected' : '' }}>{{ $statusKolam }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahIkan" class="form-label">Jumlah Ikan</label>
                        <input type="number" class="form-control" id="jumlahIkan" name="jumlah_ikan"
                            placeholder="Masukkan Jumlah Ikan" value="{{ $kolam->jumlah_ikan }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-success me-2 text-white"><a href="{{ route('index.petugas.kolam') }}"
                                class="text-decoration-none text-white">Batal</a></button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
