@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Data Pakan Keluar</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.pakan.keluar', $pakanKeluar->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="kolam_id" class="form-label">Kolam</label>
                        <select class="form-select" name="kolam_id" required>
                            @foreach($kolam as $k)
                                <option value="{{ $k->id }}" {{ $pakanKeluar->kolam_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="spesies_id" class="form-label">Jenis Ikan</label>
                        <select class="form-select" name="spesies_id" required>
                            @foreach($spesies as $s)
                                <option value="{{ $s->id }}" {{ $pakanKeluar->spesies_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->jenis_ikan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pakan_id" class="form-label">Pakan</label>
                        <select class="form-select" name="pakan_id" required>
                            @foreach($pakan as $pkt)
                                <option value="{{ $pkt->id }}" {{ $pakanKeluar->pakan_id == $pkt->id ? 'selected' : '' }}>
                                    {{ $pkt->jenis_pakan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                        <input type="date" class="form-control" name="tanggal_keluar" value="{{ $pakanKeluar->tanggal_keluar }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                        <input type="number" class="form-control" name="jumlah_keluar" value="{{ $pakanKeluar->jumlah_keluar }}" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index.pakan_keluar') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-warning text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
