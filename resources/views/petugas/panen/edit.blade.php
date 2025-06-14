@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Panen</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.petugas.panen', $panen->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Kolam --}}
                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Kolam</label>
                    <select class="form-select" id="kolam_id" name="kolam_id" required>
                        <option value="">-- Pilih Kolam --</option>
                        @foreach($kolam as $kol)
                            <option value="{{ $kol->id }}" {{ $kol->id == $panen->kolam_id ? 'selected' : '' }}>
                                {{ $kol->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Jenis Ikan --}}
                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" id="spesies_id" name="spesies_id" required>
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach($spesies as $sps)
                            <option value="{{ $sps->id }}" {{ $sps->id == $panen->spesies_id ? 'selected' : '' }}>
                                {{ $sps->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Panen --}}
                <div class="mb-3">
                    <label for="tanggal_panen" class="form-label">Tanggal Panen</label>
                    <input type="date" class="form-control" name="tanggal_panen" value="{{ $panen->tanggal_panen }}" required>
                </div>

                {{-- Berat Total Panen --}}
                <div class="mb-3">
                    <label for="berat_total" class="form-label">Berat Total Panen (kg)</label>
                    <input type="number" class="form-control" name="berat_total" value="{{ $panen->berat_total }}" required step="any">
                </div>

                {{-- Harga per kg --}}
                <div class="mb-3">
                    <label for="harga_per_kg" class="form-label">Harga per kg (Rp)</label>
                    <input type="number" class="form-control" name="harga_per_kg" value="{{ $panen->harga_per_kg }}" required>
                </div>

                {{-- Tujuan Distribusi --}}
                <div class="mb-3">
                    <label for="tujuan_distribusi" class="form-label">Tujuan Distribusi</label>
                    <textarea class="form-control" name="tujuan_distribusi" rows="3" required>{{ $panen->tujuan_distribusi }}</textarea>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.petugas.panen') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
