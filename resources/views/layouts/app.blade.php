<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem RW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #e754b6ff;
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
            background-color: #f20cb5ff;
            color: #c1499bff;
            padding-top: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #ec69c3ff;
        }

        .sidebar .nav-link {
            color: #a10a86ff;
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
            background-color: #f778d9ff;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            padding: 0;
            min-height: 100vh;
            background-color: #e130a0ff;
            display: flex;
            flex-direction: column;
        }

        .navbar-top {
            background-color: #e51dc1ff;
            padding: 15px 30px;
            border-bottom: 1px solid #ee2dbbff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-top h5 {
            margin: 0;
            color: #ed8fd7ff;
        }

        .logout-btn {
            background-color: #ae1387ff;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            color: #888;
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4>Sistem RW</h4>
        <a href="{{ route('dashboard') }}" class="nav-link {{ (isset($page) && $page == 'dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('perangkat.index') }}" class="nav-link {{ (isset($page) && $page == 'perangkat') ? 'active' : '' }}">
            Perangkat Desa
        </a>
    </div>

    {{-- Main Content --}}
    <div class="content">
        {{-- Navbar --}}
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

        {{-- Isi Halaman --}}
        <div class="main-content">
            @yield('content')
        </div>

        {{-- Footer --}}
        <div class="footer">
            <small>© 2025 Sistem RW - All Rights Reserved</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
