@auth
    @php
        $user = auth()->user();
    @endphp
@endauth

<!-- Sidebar -->
<nav id="sidebar" class="col-md-2 d-md-block sidebar shadow border-0">
    <div class="pt-3">
        @if ($user->role === App\Models\User::ROLE_ADMIN)
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-house-fill me-2"></i>
                Dashboard
            </a>
            <a href="{{ route('index.kolam') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-water me-2"></i>
                Manajemen Kolam
            </a>
            <a href="{{ route('index.spesies') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Manajemen Spesies
            </a>
            <a href="{{ route('index.benih') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Penebaran Benih
            </a>
            <a href="{{ route('index.kematian') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Manajemen Mortalitas
            </a>
            <a href="{{ route('kualitas_air.index') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Kualitas Air
            </a>
            <a href="{{ route('index.panen') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-collection-fill me-2"></i>
                Manajemen Panen
            </a>
            <div class="accordion" id="sidebarAccordion">
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed px-3 py-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePakan" aria-expanded="false"><i class="bi bi-box-fill me-2"></i>
                            Manajemen Pakan
                        </button>
                    </h2>
                    <div id="collapsePakan" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body py-0 px-0">
                            <a href="{{ route('index.pakan.Keluar') }}"
                                class="d-flex align-items-center px-3 py-2 text-dark">
                                <i class="bi bi-circle me-2"></i> Pakan Keluar
                            </a>
                            <a href="{{ route('index.pakan.masuk') }}"
                                class="d-flex align-items-center px-3 py-2 text-dark">
                                <i class="bi bi-circle me-2"></i> Pakan Masuk
                            </a>
                            <a href="{{ route('index.pakan') }}" class="d-flex align-items-center px-3 py-2 text-dark">
                                <i class="bi bi-circle me-2"></i> Pakan
                            </a>
                            <a href="{{ route('index.jadwal.pakan') }}"
                                class="d-flex align-items-center px-3 py-2 text-dark">
                                <i class="bi bi-circle me-2"></i> Jadwal Pakan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('index.pengguna') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-person-fill-add me-2"></i>
                Tambah Role
            </a>
            <a href="#" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                Laporan
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="d-flex align-items-center px-3 py-2 w-100 border-0 bg-transparent text-start logout-btn fw-bold"
                    style="color: #003049;">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        @elseif($user->role === App\Models\User::ROLE_PETUGASKOLAM)
            <a href="{{ route('petugasKolam.dashboard') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-house-fill me-2"></i>
                Dashboard
            </a>
            <a href="{{ route('index.petugas.kolam') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-water me-2"></i>
                Manajemen Kolam
            </a>
            <a href="{{ route('index.petugas.spesies') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Manajemen Spesies
            </a>
            <a href="{{ route('index.petugas.benih') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Penebaran Benih
            </a>
            <a href="{{ route('index.petugas.kematian') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Manajemen Mortalitas
            </a>
            <a href="{{ route('index.petugas.kualitasair') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-droplet-fill me-2"></i>
                Kualitas Air
            </a>
            <a href="" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-collection-fill me-2"></i>
                Manajemen Panen
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="d-flex align-items-center px-3 py-2 w-100 border-0 bg-transparent text-start logout-btn fw-bold"
                    style="color: #003049;">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        @elseif($user->role === App\Models\User::ROLE_MANAJER)
            <a href="{{ route('manajer.dashboard') }}" class="d-flex align-items-center px-3 py-2">
                <i class="bi bi-house-fill me-2"></i>
                Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="d-flex align-items-center px-3 py-2 w-100 border-0 bg-transparent text-start logout-btn fw-bold"
                    style="color: #003049;">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        @endif
    </div>
</nav>
