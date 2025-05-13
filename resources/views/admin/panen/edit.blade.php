@extends('partials.admin.main')
@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Edit Data Panen</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.panen', $panen->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kolam_id" class="form-label">Kolam</label>
                        <select class="form-select" id="kolam_id" name="kolam_id" required>
                            <option value="">-- Pilih Kolam --</option>
                            @foreach($kolam as $kolam)
                                <option value="{{ $kolam->id }}" {{ $kolam->id == $panen->kolam_id ? 'selected' : '' }}>
                                    {{ $kolam->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="spesies_id" class="form-label">Jenis Ikan</label>
                        <select class="form-select" id="spesies_id" name="spesies_id" required>
                            <option value="">-- Pilih Jenis Ikan --</option>
                            @foreach($spesies as $sps)
                                <option value="{{ $sps->id }}" {{ $sps->id == $panen->spesies_id ? 'selected' : '' }}>
                                    {{ $sps->jenis_ikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_panen" class="form-label">Tanggal Panen</label>
                        <input type="date" class="form-control" name="tanggal_panen" value="{{ $panen->tanggal_panen }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="berat_total" class="form-label">Berat Total Panen (kg)</label>
                        <input type="number" class="form-control" name="berat_total" value="{{ $panen->berat_total }}" required step="any">
                    </div>
                    <div class="mb-3">
                        <label for="harga_per_kg" class="form-label">Harga per kg (Rp)</label>
                        <input type="number" class="form-control" name="harga_per_kg" value="{{ $panen->harga_per_kg }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan_distribusi" class="form-label">Tujuan Distribusi</label>
                        <textarea class="form-control" name="tujuan_distribusi" rows="3" required>{{ $panen->tujuan_distribusi }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index.panen') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
</main>
@endsection
