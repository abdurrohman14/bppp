@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Tambah Spesies</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.petugas.spesies') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_ikan" class="form-label">Jenis Ikan</label>
                        <input type="text" class="form-control" id="jenis_ikan" name="jenis_ikan"
                            placeholder="Masukkan Jenis Ikan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                            placeholder="Masukkan Deskripsi (opsional)"></textarea>
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
