@extends('partials.admin.main')
@section('content')
    <div class="content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Edit Penebaran Benih</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.benih', $benih->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kolam" class="form-label">Nama Kolam</label>
                        <input type="text" class="form-control" id="nama_kolam" name="nama_kolam"
                            placeholder="Masukkan Nama Kolam" value="{{ $benih->nama_kolam }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_ikan" class="form-label">Jenis Ikan</label>
                        <input type="text" class="form-control" id="jenis_ikan" name="jenis_ikan"
                            placeholder="Masukkan Jenis Ikan" value="{{ $benih->jenis_ikan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ukuran_benih" class="form-label">Ukuran Benih (CM)</label>
                        <input type="number" class="form-control" id="ukuran_benih" name="ukuran_benih"
                            placeholder="Masukkan Ukuran Benih" value="{{ $benih->ukuran_benih }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_benih" class="form-label">Asal Benih</label>
                        <input type="text" class="form-control" id="asal_benih" name="asal_benih"
                            placeholder="Masukkan Asal Benih" value="{{ $benih->asal_benih }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_tebar" class="form-label">Tanggal Tebar</label>
                        <input type="date" class="form-control" id="tanggal_tebar" name="tanggal_tebar"
                            value="{{ $benih->tanggal_tebar }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_benih" class="form-label">Jumlah Benih</label>
                        <input type="number" class="form-control" id="jumlah_benih" name="jumlah_benih"
                            placeholder="Masukkan Jumlah Benih" value="{{ $benih->jumlah_benih }}" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2 text-white">
                            <a href="{{ route('index.benih') }}" class="text-decoration-none text-white">Batal</a>
                        </button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
