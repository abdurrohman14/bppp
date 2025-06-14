@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Data Pakan Masuk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.pakan.masuk', $pakanMasuk->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Untuk metode update -->

                    <!-- Pilih Pakan -->
                    <div class="mb-3">
                        <label for="pakan_id" class="form-label">Jenis Pakan</label>
                        <select class="form-select" name="pakan_id" required>
                            @foreach ($pakan as $pkt)
                                <option value="{{ $pkt->id }}"
                                    {{ $pakanMasuk->pakan_id == $pkt->id ? 'selected' : '' }}>
                                    {{ $pkt->jenis_pakan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk"
                            value="{{ $pakanMasuk->tanggal_masuk }}" required>
                    </div>

                    <!-- Jumlah Masuk -->
                    <div class="mb-3">
                        <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                        <input type="number" class="form-control" name="jumlah_masuk"
                            value="{{ $pakanMasuk->jumlah_masuk }}" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index.pakan.masuk') }}" class="btn btn-info me-2 text-white">Batal</a>
                        <button type="submit" class="btn btn-danger text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
