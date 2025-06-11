@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Edit Kualitas Air</h5>
        </div>
        <div class="card-body">

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('update.petugas.kualitasair', $air->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Jika rute update pakai POST, biarkan. Jika ingin sama dengan admin, ubah rute jadi PUT dan tambahkan @method('PUT') --}}

                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Nama Kolam</label>
                    <select class="form-select @error('kolam_id') is-invalid @enderror" id="kolam_id" name="kolam_id" required>
                        <option value="">-- Pilih Nama Kolam --</option>
                        @foreach($kolams as $kolam)
                            <option value="{{ $kolam->id }}" {{ old('kolam_id', $air->kolam_id) == $kolam->id ? 'selected' : '' }}>
                                {{ $kolam->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kolam_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengukuran" class="form-label">Tanggal Pengukuran</label>
                    <input type="date" class="form-control @error('tanggal_pengukuran') is-invalid @enderror" id="tanggal_pengukuran" name="tanggal_pengukuran" value="{{ old('tanggal_pengukuran', $air->tanggal_pengukuran) }}" required>
                    @error('tanggal_pengukuran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ph" class="form-label">Jumlah pH</label>
                    <input type="number" step="0.01" class="form-control @error('ph') is-invalid @enderror" id="ph" name="ph" value="{{ old('ph', $air->ph) }}" required>
                    @error('ph')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="temperatur" class="form-label">Temperatur (°C)</label>
                    <input type="number" step="0.1" class="form-control @error('temperatur') is-invalid @enderror" id="temperatur" name="temperatur" value="{{ old('temperatur', $air->temperatur) }}" required>
                    @error('temperatur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="oksigen_terlarut" class="form-label">Oksigen Terlarut (mg/L)</label>
                    <input type="number" step="0.1" class="form-control @error('oksigen_terlarut') is-invalid @enderror" id="oksigen_terlarut" name="oksigen_terlarut" value="{{ old('oksigen_terlarut', $air->oksigen_terlarut) }}" required>
                    @error('oksigen_terlarut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.kualitasair') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
