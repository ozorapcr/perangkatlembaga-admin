<div class="sidebar">
    <h4 class="text-white mb-4">Admin RW</h4>
    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>

    <hr>
    <p class="text-secondary fw-bold">Fitur Utama</p>
    <a href="#"><i class="fa-solid fa-database"></i> Modul A</a>
    <a href="#"><i class="fa-solid fa-list"></i> Modul B</a>

    <hr>
    <p class="text-secondary fw-bold">Master Data</p>
    <a href="#"><i class="fa-solid fa-users"></i> User</a>
    <a href="{{ route('warga.index') }}"><i class="fa-solid fa-id-card"></i> Warga</a>

    <hr>
    <a href="{{ route('logout') }}" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
