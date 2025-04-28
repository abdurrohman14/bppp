@auth
    @php
        $user = auth()->user();
    @endphp
@endauth
<!-- Sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        @if ($user->role === App\Models\User::ROLE_ADMIN)
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.kolam') }}"><i class="fas fa-water"></i>
                    Manajemen Kolam</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.spesies') }}"><i class="fas fa-fish"></i> Manajemen Spesies</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.benih') }}"><i class="fas fa-seedling"></i> Penebaran Benih</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.kematian') }}"><i class="fas fa-seedling"></i> Manajemen Mortalitas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('kualitas_air.index') }}"><i class="fas fa-tint"></i> Kualitas Air</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.panen') }}"><i class="fas fa-tint"></i> Manajemen Panen</a></li>
                <a class="nav-link active" href="#"><i class="fas fa-utensils"></i> Manajemen Pakan</a>
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link {{ request()->is('pakan-keluar*') ? 'active' : '' }}" href="{{ route('index.pakan.keluar') }}">Pakan Keluar</a></li>
                    <li><a class="nav-link {{ request()->is('pakan-masuk*') ? 'active' : '' }}" href="{{ route('index.pakan.masuk') }}">Pakan Masuk</a></li>
                    <li><a class="nav-link {{ Request::is('pakan*') ? 'active' : '' }}" href="{{ route('index.pakan') }}">Pakan</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.pengguna') }}"><i class="fas fa-user-plus"></i> Tambah Role</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Laporan</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link"
                    style="border: none; background: none; padding: 0;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        @elseif($user->role === App\Models\User::ROLE_PETUGASKOLAM)
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.kolam') }}"><i class="fas fa-water"></i>
                    Manajemen Kolam</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index.spesies') }}"><i class="fas fa-fish"></i> Manajemen Spesies</a>
                    </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.benih') }}"><i class="fas fa-seedling"></i> Penebaran Benih</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-skull-crossbones"></i> Manajemen
                    Mortalitas</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tint"></i> Kualitas Air</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-clipboard-list"></i> Manajemen
                    Panen</a></li>
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-utensils"></i> Manajemen Pakan</a>
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="#">Pakan Keluar</a></li>
                    <li><a class="nav-link" href="#">Pakan Masuk</a></li>
                    <li><a class="nav-link" href="#">Jenis Pakan</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-plus"></i> Tambah Role</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Laporan</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link"
                    style="border: none; background: none; padding: 0;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        @elseif($user->role === App\Models\User::ROLE_MANAJER)
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-home"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index.kolam') }}"><i class="fas fa-water"></i>
                    Manajemen Kolam</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-fish"></i> Manajemen
                    Spesies</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-seedling"></i> Penebaran
                    Benih</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-skull-crossbones"></i>
                    Manajemen Mortalitas</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tint"></i> Kualitas Air</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-clipboard-list"></i> Manajemen
                    Panen</a></li>
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-utensils"></i> Manajemen Pakan</a>
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="#">Pakan Keluar</a></li>
                    <li><a class="nav-link" href="#">Pakan Masuk</a></li>
                    <li><a class="nav-link" href="#">Jenis Pakan</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-plus"></i> Tambah Role</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Laporan</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link"
                    style="border: none; background: none; padding: 0;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        @endif
    </ul>
</div>
