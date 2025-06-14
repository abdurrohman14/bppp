@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="mb-0">Tambah Jadwal Pakan</h5>
            </div>
            <div class="card-body">
                <div class="form-container">
                    <form action="{{ route('jadwal.pakan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="spesies_id">Spesies Ikan</label>
                            <select name="spesies_id" class="form-control" required>
                                @foreach ($spesies as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis_ikan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3" id="jadwal_pakan_group">
                            <label for="jadwal_pakan">Jam Pakan</label>
                            <div class="jadwal_pakan">
                                <input type="time" name="jadwal_pakan[]" class="form-control mb-2" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <button type="button" class="btn btn-success text-white" id="add_waktu_pakan">Tambah Jam Pakan</button>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('index.jadwal.pakan') }}" class="btn btn-danger text-white">Batal</a>
                                <button type="submit" class="btn btn-info text-white">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Menambahkan input jam pakan baru secara dinamis
        document.getElementById('add_waktu_pakan').addEventListener('click', function () {
            var div = document.createElement('div');
            div.innerHTML = '<input type="time" name="jadwal_pakan[]" class="form-control mb-2" required>';
            document.getElementById('jadwal_pakan_group').appendChild(div);
        });
    </script>
@endsection
