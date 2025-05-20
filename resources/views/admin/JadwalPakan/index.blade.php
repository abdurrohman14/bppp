@extends('partials.admin.main')

@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Jadwal Pakan</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-sm">
                    <a href="{{ route('jadwal.pakan.create') }}" class="text-decoration-none text-white">Tambah</a>
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Spesies</th>
                                <th>Jam Pakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalPakan as $key => $pakan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pakan->spesies->jenis_ikan }}</td>
                                    <td>{{ implode(', ', $pakan->jadwal_pakan) }}</td>
                                    <td>
                                        <a href="{{ route('jadwal.pakan.edit', $pakan->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('jadwal.pakan.destroy', $pakan->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
