<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($page ?? 'Dashboard') }} - Sistem RW</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* SOFT THEME COLORS - SERAGAM SEMUA HALAMAN */
        :root {
            --primary: #e7b8e1;           /* Soft Pink */
            --primary-light: #f9e6f6;     /* Very Light Pink */
            --primary-dark: #d597cc;      /* Medium Pink */
            --primary-gradient: linear-gradient(135deg, #e7b8e1 0%, #f2d2ef 100%);
            
            --secondary: #c8b6ff;         /* Soft Lavender */
            --secondary-light: #f0ebff;   /* Light Lavender */
            --accent: #ffafcc;            /* Soft Coral Pink */
            --accent-light: #ffe3f1;      /* Light Coral Pink */
            
            --light: #fff9fe;             /* Soft White */
            --light-gradient: linear-gradient(135deg, #fff9fe 0%, #fef7ff 100%);
            --dark: #5d576b;              /* Soft Dark Purple */
            --dark-light: #8a8498;        /* Medium Gray Purple */
            --gray: #a8a2b8;              /* Soft Gray */
            --gray-light: #f0e9f2;        /* Very Light Lavender Gray */
            --gray-medium: #e7e0eb;
            
            --success: #9ce0c2;           /* Soft Mint Green */
            --warning: #ffd6a5;           /* Soft Peach */
            --danger: #ffafaf;            /* Soft Coral */
            --info: #a0c4ff;              /* Soft Sky Blue */
            
            /* UI Variables */
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
            --border-radius: 12px;
            --shadow-sm: 0 2px 12px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 15px 50px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--light-gradient);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Modern Sidebar dengan Soft Theme */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-gradient);
            color: var(--dark);
            padding: 25px 0;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            transition: var(--transition);
            overflow: hidden;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 0 25px 30px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            position: relative;
        }

        .sidebar-logo {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .sidebar-logo img {
            height: 35px;
            border-radius: 8px;
        }

        .sidebar .nav-link {
            color: var(--dark-light);
            font-weight: 500;
            padding: 16px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            border-radius: 0;
            margin: 2px 15px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-left: 4px solid transparent;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(231, 184, 225, 0.1) 0%, rgba(231, 184, 225, 0) 100%);
            transition: var(--transition);
        }

        .sidebar .nav-link:hover::before,
        .sidebar .nav-link.active::before {
            width: 100%;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--dark);
            transform: translateX(8px);
            border-left-color: var(--primary);
            background: rgba(231, 184, 225, 0.1);
        }

        .sidebar .nav-link i {
            font-size: 1.3rem;
            width: 24px;
            text-align: center;
            transition: var(--transition);
            color: var(--dark-light);
        }

        .sidebar .nav-link:hover i,
        .sidebar .nav-link.active i {
            color: var(--primary-dark);
            transform: scale(1.1);
        }

        /* Main Content Area */
        .content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        /* Modern Header dengan Soft Theme */
        .navbar-top {
            background: var(--light-gradient);
            padding: 0 35px;
            height: var(--header-height);
            border-bottom: 1px solid var(--gray-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-top h5 {
            margin: 0;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-icons i {
            color: var(--dark-light);
            font-size: 1.3rem;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            padding: 8px;
            border-radius: 12px;
        }

        .navbar-icons i:hover {
            color: var(--primary-dark);
            background: var(--primary-light);
        }

        .notification-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .logout-btn {
            background: var(--primary-light);
            border: 1px solid var(--primary);
            color: var(--dark);
            cursor: pointer;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 500;
        }

        .logout-btn:hover {
            color: var(--dark);
            transform: translateY(-2px);
            background: var(--primary);
            box-shadow: var(--shadow-md);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 35px;
            background: var(--light-gradient);
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
            opacity: 0.3;
            pointer-events: none;
        }

        /* Enhanced Cards dengan Soft Theme */
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid var(--gray-light);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--gray-light);
        }

        .content-title {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            font-size: 1.8rem;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: var(--dark-light);
            border-top: 1px solid var(--gray-light);
            background: rgba(255,255,255,0.95);
            font-size: 0.9rem;
        }

        /* Enhanced Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 70px;
            height: 70px;
            bottom: 30px;
            right: 30px;
            background: var(--primary-gradient);
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 32px;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            animation: float 3s ease-in-out infinite;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 15px 35px rgba(231, 184, 225, 0.4);
            animation: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Enhanced CRUD Buttons dengan Soft Theme */
        .btn-crud {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            border: none;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            text-decoration: none;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-crud::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: var(--transition);
        }

        .btn-crud:hover::before {
            left: 100%;
        }

        .btn-crud:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .btn-tambah {
            background: linear-gradient(135deg, var(--success) 0%, #b4e6d1 100%);
            color: var(--dark);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning) 0%, #ffe0b8 100%);
            color: var(--dark);
        }

        .btn-hapus {
            background: linear-gradient(135deg, var(--danger) 0%, #ffc9c9 100%);
            color: var(--dark);
        }

        .btn-simpan {
            background: linear-gradient(135deg, var(--secondary) 0%, #ddd2ff 100%);
            color: var(--dark);
        }

        .btn-kembali {
            background: linear-gradient(135deg, var(--gray) 0%, #d9d3e3 100%);
            color: var(--dark);
        }

        .btn-detail {
            background: linear-gradient(135deg, var(--info) 0%, #c2d7ff 100%);
            color: var(--dark);
        }

        /* Enhanced Stats Cards dengan Soft Theme */
        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--gray-light);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .stats-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .stats-card:hover .stats-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stats-icon.primary { background: rgba(231, 184, 225, 0.15); color: var(--primary-dark); }
        .stats-icon.success { background: rgba(156, 224, 194, 0.15); color: var(--success); }
        .stats-icon.warning { background: rgba(255, 214, 165, 0.15); color: var(--warning); }
        .stats-icon.info { background: rgba(160, 196, 255, 0.15); color: var(--info); }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--dark);
            line-height: 1;
        }

        .stats-label {
            color: var(--dark-light);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Enhanced Table Styling dengan Soft Theme */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-light);
        }

        .table thead th {
            background: var(--primary-gradient);
            color: var(--dark);
            font-weight: 600;
            border: none;
            padding: 20px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-color: rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(231, 184, 225, 0.08);
            transform: translateX(5px);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            :root {
                --sidebar-width: 80px;
            }

            .sidebar-logo span,
            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link {
                justify-content: center;
                padding: 16px 0;
            }

            .sidebar .nav-link:hover,
            .sidebar .nav-link.active {
                transform: translateX(0);
            }

            .content {
                margin-left: var(--sidebar-width);
            }
        }

        @media (max-width: 768px) {
            .navbar-top h5 span {
                display: none;
            }

            .main-content {
                padding: 20px;
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .content-title {
                font-size: 1.5rem;
            }

            .navbar-top {
                padding: 0 20px;
            }

            .logout-btn span {
                display: none;
            }
            
            .whatsapp-float {
                width: 60px;
                height: 60px;
                font-size: 28px;
                bottom: 20px;
                right: 20px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Loading Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(231, 184, 225, 0.3);
            border-left: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 30px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--dark-light);
        }

        .empty-state i {
            font-size: 5rem;
            color: var(--primary-light);
            margin-bottom: 25px;
            opacity: 0.7;
        }

        .empty-state h4 {
            color: var(--dark);
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Custom Scrollbar dengan Soft Theme */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Nav Header Styling */
        .nav-header {
            color: var(--dark-light) !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            padding: 20px 25px 10px !important;
            margin: 0 !important;
            font-weight: 600 !important;
        }
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('assets/img/LogoRw.jpg') }}" alt="Logo Sistem RW">
                <span>Sistem RW</span>
            </div>
        </div>

        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" 
               class="nav-link {{ isset($page) && $page == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> 
                <span>Dashboard</span>
            </a>

            <a href="{{ route('perangkat.index') }}"
               class="nav-link {{ isset($page) && $page == 'perangkat' ? 'active' : '' }}">
                <i class="fas fa-users-gear"></i> 
                <span>Perangkat Desa</span>
            </a>

            <!-- Menu Lembaga Desa -->
            <li class="nav-header">LEMBAGA DESA</li>

            <a href="{{ route('lembaga.index') }}" 
               class="nav-link {{ request()->is('lembaga*') ? 'active' : '' }}">
                <i class="fas fa-landmark"></i> 
                <span>Data Lembaga</span>
            </a>

            <a href="{{ route('jabatan.index') }}" 
               class="nav-link {{ request()->is('jabatan*') ? 'active' : '' }}">
                <i class="fas fa-id-card"></i> 
                <span>Jabatan Lembaga</span>
            </a>

            <a href="{{ route('anggota-lembaga.index') }}" 
               class="nav-link {{ request()->is('anggota-lembaga*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> 
                <span>Anggota Lembaga</span>
            </a>

            <!-- Menu RT/RW -->
            <li class="nav-header">WILAYAH</li>

            <a href="{{ route('rw.index') }}" 
               class="nav-link {{ request()->is('rw*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> 
                <span>Data RW</span>
            </a>

            <a href="{{ route('rt.index') }}" 
               class="nav-link {{ request()->is('rt*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> 
                <span>Data RT</span>
            </a>

            <!-- Menu Warga -->
            <li class="nav-header">DATA WARGA</li>

            <a href="{{ route('warga.index') }}" 
               class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                <i class="fas fa-people-roof"></i> 
                <span>Data Warga</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navigation Bar -->
        <div class="navbar-top">
            <h5>
                <i class="fas fa-table-columns"></i> 
                <span>{{ ucfirst($page ?? 'Dashboard') }}</span>
            </h5>

            <div class="navbar-icons">
                <div style="position: relative;">
                    <i class="fas fa-bell" title="Notifikasi"></i>
                    <span class="notification-badge">3</span>
                </div>
                
                <i class="fas fa-user-circle" title="Profil" id="profileBtn"></i>

                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="logout-btn" title="Logout"
                        onclick="if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-right-from-bracket"></i>
                    <span class="d-none d-md-inline">Logout</span>
                </button>
            </div>
        </div>

        <!-- Page Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="footer">
            <small>© 2025 Sistem RW - Lembaga Pemberdayaan Masyarakat. All Rights Reserved</small>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282286304303?text=Halo%20Admin%20RW,%20saya%20ingin%20bertanya."
       class="whatsapp-float"
       target="_blank"
       title="Chat via WhatsApp">
       <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Enhanced animations
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in animation for elements
            const fadeElements = document.querySelectorAll('.fade-in');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            fadeElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(element);
            });
            
            // Profile button functionality
            const profileBtn = document.getElementById('profileBtn');
            if (profileBtn) {
                profileBtn.addEventListener('click', function() {
                    alert('Fitur profil akan segera tersedia!');
                });
            }
            
            // Smooth scroll for page transitions
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>