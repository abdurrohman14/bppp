@extends('partials.admin.main')
@section('content')
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="card shadow border-0">
            <div class="card-header ">
                <h5 class="mb-0" style="color: #003049;">Data Kematian Ikan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
            <a href="{{ route('create.kematian') }}" class="btn btn-primary btn-sm text-white">Tambah</a>
            <table class="table table-bordered table-striped" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kolam</th>
                        <th>Jenis Ikan</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Penyebab</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kematian as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->kolam->nama }}</td>
                            <td>{{ $item->spesies->jenis_ikan }}</td>
                            <td>{{ $item->tanggal_kematian }}</td>
                            <td>{{ $item->jumlah_mati }}</td>
                            <td>{{ $item->penyebab }}</td>
                            <td>
                                <a href="{{ route('edit.kematian', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('delete.kematian', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
