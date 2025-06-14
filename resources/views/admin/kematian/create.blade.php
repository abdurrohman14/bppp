@extends('partials.admin.main')

@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Kematian</h5>
        </div>
        <div class="card-body">
            {{-- Tampilkan validasi error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Periksa kembali data input:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('store.kematian') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kolam_id" class="form-label">Kolam</label>
                    <select class="form-select" id="kolam_id" name="kolam_id" required>
                        <option value="">-- Pilih Kolam --</option>
                        @foreach($kolam as $k)
                            <option value="{{ $k->id }}" {{ old('kolam_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="spesies_id" class="form-label">Jenis Ikan</label>
                    <select class="form-select" id="spesies_id" name="spesies_id" required>
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach($spesies as $sps)
                            <option value="{{ $sps->id }}" {{ old('spesies_id') == $sps->id ? 'selected' : '' }}>
                                {{ $sps->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kematian" class="form-label">Tanggal Kematian</label>
                    <input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian" value="{{ old('tanggal_kematian') }}" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_mati" class="form-label">Jumlah Kematian</label>
                    <input type="number" class="form-control" name="jumlah_mati" id="jumlah_mati" value="{{ old('jumlah_mati') }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="penyebab" class="form-label">Penyebab</label>
                    <textarea class="form-control" name="penyebab" id="penyebab" rows="3" required>{{ old('penyebab') }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('index.kematian') }}" class="btn btn-info me-2 text-white">Batal</a>
                    <button type="submit" class=" btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            confirmButtonColor: '#ffc107'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endpush
