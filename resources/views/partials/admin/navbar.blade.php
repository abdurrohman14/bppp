<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary px-3 py-3" style="height: 80px;">
  <div class="d-flex align-items-center w-100 justify-content-between">
    <div class="d-flex align-items-center" style="gap: 10px;">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="60" height="60" style="margin-top: -4px;" />
      <span class="navbar-brand mb-0 h1 fs-4" style="margin-top: 2px;">BPPP BANYUWANGI</span>
    </div>

    <div class="d-flex align-items-center">
      @auth
      <div class="dropdown me-3">
        <a href="#" class="d-block text-white text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="fs-3"><i class="bi bi-person-fill-check"></i></i></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
        </ul>
      </div>
      @endauth

      <!-- Tombol Hamburger -->
      <a href="javascript:void(0);" class="btn btn-light d-md-none" id="toggleSidebar" style="font-size: 2rem; margin-top: 9px; margin-right: 5px;">
        <i class="bi bi-list" style="transform: translateY(2px);"></i>
      </a>
    </div>
  </div>
</nav>
