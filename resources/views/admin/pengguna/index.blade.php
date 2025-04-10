@extends('partials.admin.main')
@section('content')
    <div class="content">
        <div class="table-container">
            <button class="btn btn-primary mb-3"><a href="{{ route('create.pengguna') }}"
                    class="text-decoration-none text-white">Tambah</a></button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $pengguna)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pengguna->role }}</td>
                            <td>{{ $pengguna->name }}</td>
                            <td>{{ $pengguna->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
