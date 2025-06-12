@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Data Pakan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pakan.update', $pakan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pakan" class="form-label">Jenis Pakan</label>
                        <input type="text" class="form-control" id="pakan" name="jenis_pakan" placeholder="Masukkan Nama Pakan" value="{{ $pakan->jenis_pakan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="asalPakan" class="form-label">Asal Pakan</label>
                        <input type="text" class="form-control" id="asalPakan" name="asal_pakan" placeholder="Masukkan Asal Pakan" value="{{ $pakan->asal_pakan }}" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="ukuranPakan" class="form-label">Ukuran Pakan</label>
                        <input type="text" class="form-control" id="ukuranPakan" name="ukuran_pakan" placeholder="Masukkan Ukuran Pakan" value="{{ $pakan->ukuran_pakan }}" required>
                    </div> --}}
                    <div class="mb-3">
                        <label for="jumlahPakan" class="form-label">Jumlah Pakan</label>
                        <input type="number" class="form-control" id="jumlahPakan" name="jumlah_pakan" placeholder="Masukkan Jumlah Pakan" value="{{ $pakan->jumlah_pakan }}" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2 text-white">
                            <a href="{{ route('index.pakan') }}" class="text-decoration-none text-white">Batal</a>
                        </button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
