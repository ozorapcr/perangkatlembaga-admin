<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem RW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: linear-gradient(135deg, #ff39b0ff 0%, #e715e7ff 100%);
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            width: 250px;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: rgba(237, 72, 176, 0.1);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: rgba(242, 112, 190, 0.2);
            font-weight: bold;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="text-center mb-4">
                    <h4><i class="fas fa-users"></i> Sistem RW</h4>
                    <small>Perangkat Dan Lembaga</small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('rw') ? 'active' : '' }}" href="{{ route('rw.index') }}">
                        <i class="fas fa-list me-2"></i> Data RW
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-users me-2"></i> Data Warga
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-calendar me-2"></i> Kegiatan
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-chart-bar me-2"></i> Laporan
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog me-2"></i> Pengaturan
                    </a>
                </nav>

                <div class="mt-auto p-3">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <small>Logged in as</small>
                            <h6 class="mb-0">{{ $user['username'] }}</h6>
                            <small class="text-muted">{{ $user['email'] }}</small>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>