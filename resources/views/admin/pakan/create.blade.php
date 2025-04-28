@extends('partials.admin.main')

@section('content')
<div class="content">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Tambah Pakan</h5>
        </div>
            <form action="{{ route('pakan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Pakan</label>
                    <input type="text" name="pakan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Asal Pakan</label>
                    <input type="text" name="asal_pakan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Ukuran Pakan</label>
                    <input type="text" name="ukuran_pakan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jumlah Pakan</label>
                    <input type="number" name="jumlah_pakan" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('index.pakan') }}" class="btn btn-secondary">Batal</a>
            </form>
    </div>
</div>
@endsection
