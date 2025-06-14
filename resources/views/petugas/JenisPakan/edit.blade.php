@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Pakan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.JenisPakan', $pakan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="pakan">Pakan</label>
                    <input type="text" name="jenis_pakan" class="form-control" value="{{ $pakan->jenis_pakan }}" required>
                </div>

                <div class="mb-3">
                    <label for="asal_pakan">Asal Pakan</label>
                    <input type="text" name="asal_pakan" class="form-control" value="{{ $pakan->asal_pakan }}" required>
                </div>

                {{-- <div class="mb-3">
                    <label for="ukuran_pakan">Ukuran Pakan</label>
                    <input type="text" name="ukuran_pakan" class="form-control" value="{{ $pakan->ukuran_pakan }}" required>
                </div> --}}

                <div class="mb-3">
                    <label for="jumlah_pakan">Jumlah Pakan</label>
                    <input type="number" name="jumlah_pakan" class="form-control" value="{{ $pakan->jumlah_pakan }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.JenisPakan') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
