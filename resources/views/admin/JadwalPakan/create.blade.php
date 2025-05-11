@extends('partials.admin.main')

@section('content')
<div class="content">
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

            <div class="form-group" id="jadwal_pakan_group">
                <label for="jadwal_pakan">Jam Pakan</label>
                <div class="jadwal_pakan">
                    <input type="time" name="jadwal_pakan[]" class="form-control mb-2" required>
                </div>
            </div>

            <button type="button" class="btn btn-success" id="add_waktu_pakan">Tambah Jam Pakan</button>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add_waktu_pakan').addEventListener('click', function () {
        var div = document.createElement('div');
        div.innerHTML = '<input type="time" name="jadwal_pakan[]" class="form-control mb-2" required>';
        document.getElementById('jadwal_pakan_group').appendChild(div);
    });
</script>
@endsection
