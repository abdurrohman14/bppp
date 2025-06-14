@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Manajemen Kolam</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.kolam', $kolam->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="namaKolam" class="form-label">Nama Kolam</label>
                    <input type="text" class="form-control" id="namaKolam" name="nama"
                        placeholder="Masukkan Nama Kolam" value="{{ $kolam->nama }}" required>
                </div>

                <div class="mb-3">
                    <label for="sistem" class="form-label">Sistem yang Digunakan</label>
                    <select class="form-select" id="sistem" name="budaya" required>
                        @foreach ($budaya as $budayaKolam)
                            <option value="{{ $budayaKolam }}" {{ $kolam->budaya == $budayaKolam ? 'selected' : '' }}>
                                {{ $budayaKolam }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach ($status as $statusKolam)
                            <option value="{{ $statusKolam }}" {{ $kolam->status == $statusKolam ? 'selected' : '' }}>
                                {{ $statusKolam }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlahIkan" class="form-label">Jumlah Ikan</label>
                    <input type="number" class="form-control" id="jumlahIkan" name="jumlah_ikan"
                        placeholder="Masukkan Jumlah Ikan" value="{{ $kolam->jumlah_ikan }}" required>
                </div>

                <div class="mb-3">
                    <label for="ukuran_kolam" class="form-label">Ukuran Kolam (mm)</label>
                    <input type="text" class="form-control" id="ukuran_kolam" name="ukuran_kolam"
                        placeholder="Contoh: 2000mm x 1000mm x 800mm" value="{{ $kolam->ukuran_kolam }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.kolam') }}" class="btn btn-info me-2 text-white text-decoration-none">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
