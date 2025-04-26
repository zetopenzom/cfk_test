{{-- sidebar menu --}}
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    {{-- header --}}
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Kaltim Electrik Power</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    {{-- menu list --}}
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
        {{-- beranda --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/beranda">
                <svg class="bi" aria-hidden="true"><use xlink:href="#house-fill"/></svg>
                Beranda
            </a>
        </li>
        {{-- admin user --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/user">
                <svg class="bi" aria-hidden="true"><use xlink:href="#file-earmark"/></svg>
                Adminstrasi User
            </a>
        </li>
        {{-- tambah --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/tambah">
                <svg class="bi" aria-hidden="true"><use xlink:href="#cart"/></svg>
                Tambah Data Lembur
            </a>
        </li>
        {{-- lihat --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/lihat">
                <svg class="bi" aria-hidden="true"><use xlink:href="#people"/></svg>
                Lihat Data Lembur
            </a>
        </li>
        {{-- persetujuan --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/persetujuan">
                <svg class="bi" aria-hidden="true"><use xlink:href="#graph-up"/></svg>
                Persetujuan Lembur
            </a>
        </li>
        </ul>
        <hr class="my-3">
        {{-- akun and sign out --}}
        <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/akun">
                <svg class="bi" aria-hidden="true"><use xlink:href="#gear-wide-connected"/></svg>
                Akun Saya
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/signout">
                <svg class="bi" aria-hidden="true"><use xlink:href="#door-closed"/></svg>
                Sign out
            </a>
        </li>
        </ul>
    </div>
    </div>
</div>