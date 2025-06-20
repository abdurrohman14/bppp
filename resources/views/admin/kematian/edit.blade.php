@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Kematian</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.kematian', $kematian->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Kolam</label>
                    <select class="form-select" name="kolam_id" required>
                        @foreach($kolam as $k)
                            <option value="{{ $k->id }}" {{ old('kolam_id', $kematian->kolam_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" name="spesies_id" required>
                        @foreach($spesies as $s)
                            <option value="{{ $s->id }}" {{ old('spesies_id', $kematian->spesies_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_mati" class="form-label">Tanggal Kematian</label>
                    <input type="date" class="form-control" name="tanggal_kematian"
                        value="{{ old('tanggal_kematian', \Carbon\Carbon::parse($kematian->tanggal_kematian)->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_kematian" class="form-label">Jumlah Kematian</label>
                    <input type="number" class="form-control" name="jumlah_mati"
                        value="{{ old('jumlah_mati', $kematian->jumlah_mati) }}" required>
                </div>

                <div class="mb-3">
                    <label for="penyebab" class="form-label">Penyebab</label>
                    <textarea class="form-control" name="penyebab" rows="3" required>{{ old('penyebab', $kematian->penyebab) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.kematian') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
