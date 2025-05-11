@extends('partials.admin.main')
@section('content')
<div class="content">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Form Edit Data Pakan Keluar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pakan.Keluar.update', $pakanKeluar->id) }}" method="POST">
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
                    <label for="pakan_id" class="form-label">Pakan</label>
                    <select class="form-select" id="pakan_id" name="pakan_id" required>
                        @foreach($pakan as $pkt)
                            <option value="{{ $pkt->id }}" {{ old('pakan_id', $pakanKeluar->pakan_id) == $pkt->id ? 'selected' : '' }}>
                                {{ $pkt->pakan }}
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
                    <a href="{{ route('index.pakan.Keluar') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
