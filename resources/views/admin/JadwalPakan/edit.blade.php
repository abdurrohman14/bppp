@extends('partials.admin.main')

@section('content')
    <div class="content">
        <div class="form-container">
            <form action="{{ route('jadwal.pakan.update', $jadwalPakan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="spesies_id">Spesies Ikan</label>
                    <select name="spesies_id" class="form-control" required>
                        @foreach ($spesies as $spesies)
                            <option value="{{ $spesies->id }}" {{ $jadwalPakan->spesies_id == $spesies->id ? 'selected' : '' }}>
                                {{ $spesies->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="jadwal_pakan_group">
                    <label for="jadwal_pakan">Jam Pakan</label>
                    <div class="jadwal_pakan">
                        @foreach (explode(', ', $jadwalPakan->jadwal_pakan) as $waktu)
                            <input type="time" name="jadwal_pakan[]" class="form-control mb-2" value="{{ $waktu }}" required>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="btn btn-success" id="add_waktu_pakan">Tambah Jam Pakan</button>

                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add_jadwal_pakan').addEventListener('click', function() {
            var div = document.createElement('div');
            div.classList.add('jadwal_pakan');
            div.innerHTML = '<input type="time" name="jadwal_pakan[]" class="form-control mb-2" required>';
            document.getElementById('jadwal_pakan_group').appendChild(div);
        });
    </script>
@endsection
