@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Pakan Masuk</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.PakanMasuk', $pakanMasuk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Jenis Pakan -->
                <div class="mb-3">
                    <label for="pakan_id" class="form-label">Jenis Pakan</label>
                    <select class="form-select" id="pakan_id" name="pakan_id" required>
                        @foreach ($pakan as $pkt)
                            <option value="{{ $pkt->id }}" {{ old('pakan_id', $pakanMasuk->pakan_id) == $pkt->id ? 'selected' : '' }}>
                                {{ $pkt->jenis_pakan ?? $pkt->pakan ?? 'Nama Pakan Tidak Ditemukan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Masuk -->
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $pakanMasuk->tanggal_masuk) }}" required>
                </div>

                <!-- Jumlah Masuk -->
                <div class="mb-3">
                    <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                    <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk"
                        value="{{ old('jumlah_masuk', $pakanMasuk->jumlah_masuk) }}" required>
                </div>

                <!-- Asal Pakan -->
                <div class="mb-3">
                    <label for="asal_pakan" class="form-label">Asal Pakan</label>
                    <input type="text" class="form-control" id="asal_pakan" name="asal_pakan"
                        value="{{ old('asal_pakan', $pakanMasuk->asal_pakan) }}" required>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.PakanMasuk') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
