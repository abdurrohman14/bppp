@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Penebaran Benih</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.petugas.benih') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kolam_id" class="form-label">Kolam</label>
                        <select class="form-select" id="kolam_id" name="kolam_id" required>
                            <option value="">-- Pilih Nama Kolam --</option>
                            @foreach ($kolam as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="spesies_id" class="form-label">Jenis Ikan</label>
                        <select class="form-select" id="spesies_id" name="spesies_id" required>
                            <option value="">-- Pilih Jenis Ikan --</option>
                            @foreach ($spesies as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->jenis_ikan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran Benih (CM)</label>
                        <input type="number" class="form-control" id="ukuran" name="ukuran" placeholder="Masukkan Ukuran Benih" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_benih" class="form-label">Asal Benih</label>
                        <input type="text" class="form-control" id="asal_benih" name="asal_benih" placeholder="Masukkan Asal Benih" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_tebar" class="form-label">Tanggal Tebar Benih</label>
                        <input type="date" class="form-control" id="tanggal_tebar" name="tanggal_tebar" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_benih" class="form-label">Banyak Benih</label>
                        <input type="number" class="form-control" id="jumlah_benih" name="jumlah_benih" placeholder="Masukkan Jumlah Benih" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2 text-white">
                            <a href="{{ route('index.petugas.benih') }}" class="text-decoration-none text-white">Batal</a>
                        </button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
