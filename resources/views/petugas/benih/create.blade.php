@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Form Penebaran Benih (Petugas)</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.petugas.benih') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kolam_id" class="form-label">Kolam</label>
                        <select class="form-select" id="kolam_id" name="kolam_id" required>
                            <option value="">-- Pilih Kolam --</option>
                            @foreach($kolam as $kol)
                                <option value="{{ $kol->id }}">{{ $kol->nama }}</option>
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
                        <label for="ukuran" class="form-label">Ukuran Benih (CM)</label>
                        <input type="number" class="form-control" id="ukuran" name="ukuran" placeholder="Ukuran Benih" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_benih" class="form-label">Asal Benih</label>
                        <input type="text" class="form-control" id="asal_benih" name="asal_benih" placeholder="Asal Benih" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_tebar" class="form-label">Tanggal Tebar</label>
                        <input type="date" class="form-control" id="tanggal_tebar" name="tanggal_tebar" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_benih" class="form-label">Jumlah Benih</label>
                        <input type="number" class="form-control" id="jumlah_benih" name="jumlah_benih" placeholder="Jumlah Benih" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index.petugas.benih') }}" class="btn btn-info me-2 text-white">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
