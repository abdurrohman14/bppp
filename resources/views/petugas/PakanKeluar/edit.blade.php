@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.PakanKeluar', $pakanKeluar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kolam -->
                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Kolam</label>
                    <select class="form-select" id="kolam_id" name="kolam_id" required>
                        @foreach($kolam as $k)
                            <option value="{{ $k->id }}" {{ old('kolam_id', $pakanKeluar->kolam_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Spesies -->
                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" id="spesies_id" name="spesies_id" required>
                        @foreach($spesies as $sps)
                            <option value="{{ $sps->id }}" {{ old('spesies_id', $pakanKeluar->spesies_id) == $sps->id ? 'selected' : '' }}>
                                {{ $sps->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pakan -->
                <div class="mb-3">
                    <label for="pakan_id" class="form-label">Jenis Pakan</label>
                    <select class="form-select" id="pakan_id" name="pakan_id" required>
                        @foreach($pakan as $pkt)
                            <option value="{{ $pkt->id }}" {{ old('pakan_id', $pakanKeluar->pakan_id) == $pkt->id ? 'selected' : '' }}>
                                {{ $pkt->jenis_pakan ?? $pkt->pakan ?? 'Nama Pakan Tidak Ditemukan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Keluar -->
                <div class="mb-3">
                    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" value="{{ old('tanggal_keluar', $pakanKeluar->tanggal_keluar) }}" required>
                </div>

                <!-- Jumlah Keluar -->
                <div class="mb-3">
                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                    <input type="number" class="form-control" name="jumlah_keluar" value="{{ old('jumlah_keluar', $pakanKeluar->jumlah_keluar) }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.PakanKeluar') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
