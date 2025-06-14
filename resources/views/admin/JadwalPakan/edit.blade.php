@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="mb-0">Edit Jadwal Pakan</h5>
            </div>
            <div class="card-body">
                <div class="form-container">
                    <form action="{{ route('jadwal.pakan.update', $jadwalPakan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="spesies_id">Spesies Ikan</label>
                            <select name="spesies_id" class="form-control" required>
                                @foreach ($spesies as $sp)
                                    <option value="{{ $sp->id }}" {{ $jadwalPakan->spesies_id == $sp->id ? 'selected' : '' }}>
                                        {{ $sp->jenis_ikan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="jadwal_pakan">Jam Pakan</label>
                            <div id="jadwal_pakan_group">
                                @foreach ($jadwalPakan->jadwal_pakan as $waktu)
                                    <div class="input-group mb-2">
                                        <input type="time" name="jadwal_pakan[]" class="form-control" value="{{ $waktu }}" required>
                                        <button type="button" class="btn btn-danger btn-sm remove-jadwal">×</button>
                                    </div>
                                @endforeach
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
        document.getElementById('add_waktu_pakan').addEventListener('click', function () {
            const group = document.createElement('div');
            group.classList.add('input-group', 'mb-2');
            group.innerHTML = `
                <input type="time" name="jadwal_pakan[]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-sm remove-jadwal">×</button>
            `;
            document.getElementById('jadwal_pakan_group').appendChild(group);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-jadwal')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
