<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($page ?? 'Dashboard') }} - Sistem RW</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

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
            background-color: #f068cc;
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
            display: flex;
            align-items: center;
            gap: 10px;
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
            background-color: #f559d8;
            padding: 15px 30px;
            border-bottom: 1px solid #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-top h5 {
            margin: 0;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-icons i {
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
        }

        .navbar-icons i:hover {
            color: #ffe3f9;
        }

        .logout-btn {
            background-color: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            transition: 0.2s;
        }

        .logout-btn:hover {
            color: #ffe3f9;
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

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 25px;
            right: 25px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 28px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            transform: scale(1.1);
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Tombol CRUD */
        .btn-crud {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 6px;
        }

        .btn-tambah { background-color: #28a745; color: #fff; }
        .btn-edit { background-color: #ffc107; color: #000; }
        .btn-hapus { background-color: #dc3545; color: #fff; }
        .btn-simpan { background-color: #0d6efd; color: #fff; }
        .btn-kembali { background-color: #6c757d; color: #fff; }
        .btn-detail { background-color: #17a2b8; color: #fff; }

        .btn-crud:hover {
            opacity: 0.9;
        }

    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4><i class="fa-solid fa-house-user me-2"></i>Sistem RW</h4>

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ (isset($page) && $page == 'dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <a href="{{ route('perangkat.index') }}"
           class="nav-link {{ (isset($page) && $page == 'perangkat') ? 'active' : '' }}">
            <i class="fa-solid fa-users-gear"></i> Perangkat Desa
        </a>

        <a href="{{ route('rw.index') }}"
           class="nav-link {{ (isset($page) && $page == 'rw') ? 'active' : '' }}">
            <i class="fa-solid fa-user-tie"></i> Data RW
        </a>

        <a href="{{ route('warga.index') }}"
           class="nav-link {{ (isset($page) && $page == 'warga') ? 'active' : '' }}">
            <i class="fa-solid fa-people-roof"></i> Data Warga
        </a>
    </div>

    {{-- Konten utama --}}
    <div class="content">
        {{-- Navbar atas --}}
        <div class="navbar-top">
            <h5><i class="fa-solid fa-table-columns"></i> {{ ucfirst($page ?? 'Dashboard') }}</h5>

            <div class="navbar-icons">
                <i class="fa-solid fa-bell" title="Notifikasi"></i>
                <i class="fa-solid fa-user-circle" title="Profil"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="logout-btn" title="Logout"
                        onclick="if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </div>
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

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20RW,%20saya%20ingin%20bertanya."
       class="whatsapp-float"
       target="_blank"
       title="Chat via WhatsApp">
       <i class="fa-brands fa-whatsapp"></i>
    </a>

</body>
</html>
