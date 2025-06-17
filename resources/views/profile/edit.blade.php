@extends('partials.admin.main')
@section('content')
<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
<div class="container py-5">
    <h3 class="mb-4">Edit Profil</h3>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form update nama dan email --}}
    <div class="card mb-4">
        <div class="card-header">Informasi Akun</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
</main>
@endsection
