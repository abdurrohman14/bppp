@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Spesies</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.spesies', $spesies->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="jenisIkan" class="form-label fw-bold">Jenis Ikan</label>
                    <input type="text" class="form-control" id="jenisIkan" name="jenis_ikan"
                        value="{{ old('jenis_ikan', $spesies->jenis_ikan) }}" placeholder="Masukkan Jenis Ikan" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"
                        placeholder="Masukkan deskripsi spesies..." required>{{ old('deskripsi', $spesies->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.spesies') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
