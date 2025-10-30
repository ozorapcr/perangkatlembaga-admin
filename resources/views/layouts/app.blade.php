<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($page ?? 'Dashboard') }} - Sistem RW</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fce4f6;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 240px;
            background-color: #e70fad;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #fff;
        }

        .sidebar .nav-link {
            color: #f9e8f5;
            font-weight: 500;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            border-radius: 6px;
            margin: 4px 8px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #f778d9;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            background-color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-top {
            background-color: #e51dc1;
            padding: 15px 30px;
            border-bottom: 1px solid #ee2dbb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-top h5 {
            margin: 0;
            color: #fff;
        }

        .logout-btn {
            background-color: #ae1387;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.2s;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c21b97;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            color: #555;
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4>Sistem RW</h4>

        <a href="{{ route('dashboard') }}" 
           class="nav-link {{ (isset($page) && $page == 'dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('perangkat.index') }}" 
           class="nav-link {{ (isset($page) && $page == 'perangkat') ? 'active' : '' }}">
            Perangkat Desa
        </a>

        <a href="{{ route('rw.index') }}" 
           class="nav-link {{ (isset($page) && $page == 'rw') ? 'active' : '' }}">
            Data RW
        </a>

        <!-- ✅ Tambahan Baru -->
        <a href="{{ route('warga.index') }}" 
           class="nav-link {{ (isset($page) && $page == 'warga') ? 'active' : '' }}">
            Data Warga
        </a>
    </div>

    {{-- Konten utama --}}
    <div class="content">
        {{-- Navbar atas --}}
        <div class="navbar-top">
            <h5>{{ ucfirst($page ?? 'Dashboard') }}</h5>

            {{-- Tombol Logout --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <button class="logout-btn" onclick="if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
                Logout
            </button>
        </div>

        {{-- Isi halaman --}}
        <div class="main-content">
            @yield('content')
        </div>

        {{-- Footer --}}
        <div class="footer">
            <small>© 2025 Sistem RW - All Rights Reserved</small>
        </div>
    </div>

</body>
</html>
