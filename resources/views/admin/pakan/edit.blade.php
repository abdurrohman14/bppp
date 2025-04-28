@extends('partials.admin.main')

@section('content')
<div class="container">
    <h1>Edit Pakan</h1>

    <form action="{{ route('pakan.update', $pakan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pakan</label>
            <input type="text" name="pakan" class="form-control" value="{{ $pakan->pakan }}" required>
        </div>

        <div class="mb-3">
            <label>Asal Pakan</label>
            <input type="text" name="asal_pakan" class="form-control" value="{{ $pakan->asal_pakan }}" required>
        </div>

        <div class="mb-3">
            <label>Ukuran Pakan</label>
            <input type="text" name="ukuran_pakan" class="form-control" value="{{ $pakan->ukuran_pakan }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Pakan</label>
            <input type="number" name="jumlah_pakan" class="form-control" value="{{ $pakan->jumlah_pakan }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pakan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
