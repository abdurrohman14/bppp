@extends('partials.admin.main')
@section('content')
<div class="content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Edit Penebaran Benih</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.benih', $benih->id) }}" method="POST">
                @csrf
                @method('POST') {{-- atau PUT kalau route-nya pakai method PUT --}}
                
                {{-- Kolam --}}
                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Nama Kolam</label>
                    <select class="form-select" id="kolam_id" name="kolam_id" required>
                        <option value="">-- Pilih Nama Kolam --</option>
                        @foreach($kolam as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $benih->kolam_id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Spesies --}}
                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" id="spesies_id" name="spesies_id" required>
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach($spesies as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $benih->spesies_id ? 'selected' : '' }}>
                                {{ $s->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ukuran --}}
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran Benih (CM)</label>
                    <input type="number" class="form-control" id="ukuran" name="ukuran"
                        value="{{ $benih->ukuran }}" required>
                </div>

                {{-- Asal --}}
                <div class="mb-3">
                    <label for="asal_benih" class="form-label">Asal Benih</label>
                    <input type="text" class="form-control" id="asal_benih" name="asal_benih"
                        value="{{ $benih->asal_benih }}" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label for="tanggal_tebar" class="form-label">Tanggal Tebar</label>
                    <input type="date" class="form-control" id="tanggal_tebar" name="tanggal_tebar"
                        value="{{ $benih->tanggal_tebar }}" required>
                </div>

                {{-- Jumlah --}}
                <div class="mb-3">
                    <label for="jumlah_benih" class="form-label">Jumlah Benih</label>
                    <input type="number" class="form-control" id="jumlah_benih" name="jumlah_benih"
                        value="{{ $benih->jumlah_benih }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.benih') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
