@extends('partials.admin.main')
@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3">
                <a href="{{ route('create.pengguna') }}" class="text-decoration-none text-white">Tambah</a>
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $pengguna)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pengguna->role }}</td>
                            <td>{{ $pengguna->name }}</td>
                            <td>{{ $pengguna->email }}</td>
                            <td>{{ $pengguna->whatsapp }}</td>
                            <td>
                                <a href="{{ route('edit.pengguna', $pengguna->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('delete.pengguna', $pengguna->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
