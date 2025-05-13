@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Kualitas Air</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kualitas_air.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kolam_id" class="form-label">Nama Kolam</label>
                        <select class="form-select" id="kolam_id" name="kolam_id" required>
                            <option value="">-- Pilih Nama Kolam --</option>
                            @foreach($kolams as $kolam)
                                <option value="{{ $kolam->id }}">{{ $kolam->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengukuran" class="form-label">Tanggal Pengukuran</label>
                        <input type="date" class="form-control" id="tanggal_pengukuran" name="tanggal_pengukuran" required>
                    </div>

                    <div class="mb-3">
                        <label for="ph" class="form-label">Jumlah pH</label>
                        <input type="number" step="0.01" class="form-control" id="ph" name="ph" placeholder="Masukkan pH" required>
                        @error('ph')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="temperatur" class="form-label">Temperatur (°C)</label>
                        <input type="number" step="0.1" class="form-control" id="temperatur" name="temperatur" placeholder="Masukkan Temperatur" required>
                    </div>

                    <div class="mb-3">
                        <label for="oksigen_terlarut" class="form-label">Oksigen Terlarut (mg/L)</label>
                        <input type="number" step="0.1" class="form-control" id="oksigen_terlarut" name="oksigen_terlarut" placeholder="Masukkan Oksigen Terlarut" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2 text-white">
                            <a href="{{ route('kualitas_air.index') }}" class="text-decoration-none text-white">Batal</a>
                        </button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
</main>
@endsection
