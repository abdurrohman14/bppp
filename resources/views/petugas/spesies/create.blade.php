@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Manajemen Spesies</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('store.petugas.spesies') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="jenisIkan" class="form-label">Jenis Ikan</label>
                    <input type="text" class="form-control" id="jenisIkan" name="jenis_ikan"
                        placeholder="Masukkan Jenis Ikan" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <div class="form-floating">
                        <textarea class="form-control" name="deskripsi" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-info me-2 text-white">
                        <a href="{{ route('index.petugas.spesies') }}" class="text-decoration-none text-white">Batal</a>
                    </button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
