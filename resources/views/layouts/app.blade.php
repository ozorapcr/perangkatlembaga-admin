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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #f068cc;
            --primary-light: #f9b0e4;
            --primary-dark: #e83cb0;
            --primary-gradient: linear-gradient(135deg, #f068cc 0%, #ff6b9d 100%);
            --secondary: #8a4fff;
            --accent: #ff6b9d;
            --light: #fff9fd;
            --light-gradient: linear-gradient(135deg, #fff9fd 0%, #fef7ff 100%);
            --dark: #2d3748;
            --dark-light: #4a5568;
            --gray: #718096;
            --gray-light: #e2e8f0;
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #f56565;
            --info: #4299e1;
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
            --border-radius: 16px;
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 15px 50px rgba(0, 0, 0, 0.15);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* Sidebar Modern */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-gradient);
            color: #fff;
            padding: 25px 0;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            transition: var(--transition);
            overflow: hidden;
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 25px;
            position: relative;
        }

        .sidebar h4 {
            font-weight: 700;
            color: #fff;
            margin: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .sidebar .logo-icon {
            font-size: 2rem;
            color: #fff;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
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
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
            transition: var(--transition);
        }

        .sidebar .nav-link:hover::before,
        .sidebar .nav-link.active::before {
            width: 100%;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            transform: translateX(8px);
            border-left-color: rgba(255,255,255,0.6);
            background: rgba(255,255,255,0.1);
        }

        .sidebar .nav-link i {
            font-size: 1.3rem;
            width: 24px;
            text-align: center;
            transition: var(--transition);
        }

        .sidebar .nav-link:hover i,
        .sidebar .nav-link.active i {
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

        /* Modern Header */
        .navbar-top {
            background: var(--primary-gradient);
            padding: 0 35px;
            height: var(--header-height);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 999;
            backdrop-filter: blur(10px);
        }

        .navbar-top h5 {
            margin: 0;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 1.4rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-icons i {
            color: #fff;
            font-size: 1.3rem;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            padding: 8px;
            border-radius: 12px;
        }

        .navbar-icons i:hover {
            color: #ffe3f9;
            transform: translateY(-2px);
            background: rgba(255,255,255,0.1);
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
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            color: #ffe3f9;
            transform: translateY(-2px);
            background: rgba(255,255,255,0.25);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
            opacity: 0.05;
            pointer-events: none;
        }

        /* Enhanced Cards */
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255,255,255,0.8);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
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
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            border-top: 1px solid var(--gray-light);
            background: rgba(255,255,255,0.9);
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
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
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.4);
            animation: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Enhanced CRUD Buttons */
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
            background: linear-gradient(135deg, var(--success) 0%, #38a169 100%);
            color: #fff;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning) 0%, #dd6b20 100%);
            color: #fff;
        }

        .btn-hapus {
            background: linear-gradient(135deg, var(--danger) 0%, #e53e3e 100%);
            color: #fff;
        }

        .btn-simpan {
            background: linear-gradient(135deg, var(--secondary) 0%, #7c3aed 100%);
            color: #fff;
        }

        .btn-kembali {
            background: linear-gradient(135deg, var(--gray) 0%, #4a5568 100%);
            color: #fff;
        }

        .btn-detail {
            background: linear-gradient(135deg, var(--info) 0%, #3182ce 100%);
            color: #fff;
        }

        /* Enhanced Stats Cards */
        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.8);
            height: 100%;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
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

        .stats-icon.primary { background: rgba(240, 104, 204, 0.15); color: var(--primary); }
        .stats-icon.success { background: rgba(72, 187, 120, 0.15); color: var(--success); }
        .stats-icon.warning { background: rgba(237, 137, 54, 0.15); color: var(--warning); }
        .stats-icon.info { background: rgba(66, 153, 225, 0.15); color: var(--info); }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--dark);
            line-height: 1;
        }

        .stats-label {
            color: var(--gray);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Enhanced Table Styling */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
        }

        .table thead th {
            background: var(--primary-gradient);
            color: #fff;
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
            background: rgba(240, 104, 204, 0.08);
            transform: translateX(5px);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            :root {
                --sidebar-width: 80px;
            }

            .sidebar h4 span,
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
            border: 4px solid rgba(240, 104, 204, 0.3);
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
            color: var(--gray);
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

        /* Custom Scrollbar */
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
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-house-user logo-icon"></i> <span>Sistem RW</span></h4>
        </div>

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ (isset($page) && $page == 'dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('perangkat.index') }}"
           class="nav-link {{ (isset($page) && $page == 'perangkat') ? 'active' : '' }}">
            <i class="fa-solid fa-users-gear"></i> <span>Perangkat Desa</span>
        </a>

        <a href="{{ route('rw.index') }}"
           class="nav-link {{ (isset($page) && $page == 'rw') ? 'active' : '' }}">
            <i class="fa-solid fa-user-tie"></i> <span>Data RW</span>
        </a>

        <a href="{{ route('warga.index') }}"
           class="nav-link {{ (isset($page) && $page == 'warga') ? 'active' : '' }}">
            <i class="fa-solid fa-people-roof"></i> <span>Data Warga</span>
        </a>
    </div>

    {{-- Konten utama --}}
    <div class="content">
        {{-- Navbar atas --}}
        <div class="navbar-top">
            <h5><i class="fa-solid fa-table-columns"></i> <span>{{ ucfirst($page ?? 'Dashboard') }}</span></h5>

            <div class="navbar-icons">
                <div style="position: relative;">
                    <i class="fa-solid fa-bell" title="Notifikasi"></i>
                    <span class="notification-badge">3</span>
                </div>
                <i class="fa-solid fa-user-circle" title="Profil"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="logout-btn" title="Logout"
                        onclick="if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="d-none d-md-inline">Logout</span>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Enhanced animations
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const fadeInObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                        fadeInObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            fadeElements.forEach(element => {
                element.style.opacity = "0";
                element.style.transform = "translateY(30px)";
                element.style.transition = "opacity 0.6s ease, transform 0.6s ease";
                fadeInObserver.observe(element);
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.btn-crud').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255,255,255,0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                    `;

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
