<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem RW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(255, 0, 157, 0.1);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .welcome-banner {
            background: linear-gradient(135deg, #ea66c0ff 0%, #d834caff 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-users"></i> Sistem RW
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i> {{ $user['username'] }} ({{ $user['role'] }})
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Selamat Datang, {{ $user['username'] }}! 👋</h2>
                    <p class="mb-0">Selamat datang di Perangkat Dan Lembaga. Kelola data RW dengan mudah dan efisien.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-chart-line fa-4x opacity-75"></i>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Total RW</h6>
                                <h3 class="text-primary">{{ $stats['total_rw'] }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-map-marked-alt fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Total Warga</h6>
                                <h3 class="text-success">{{ number_format($stats['total_warga']) }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Total RT</h6>
                                <h3 class="text-warning">{{ $stats['total_rt'] }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-home fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Kegiatan Aktif</h6>
                                <h3 class="text-info">{{ $stats['active_events'] }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-calendar-check fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities & Quick Actions -->
        <div class="row">
            <!-- Recent Activities -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-history me-2"></i> Aktivitas Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($activities as $activity)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="{{ $activity['icon'] }} me-2 text-primary"></i>
                                    {{ $activity['text'] }}
                                </div>
                                <small class="text-muted">{{ $activity['time'] }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i> Akses Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('rw.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                <i class="fas fa-list me-2"></i> Lihat Data RW
                            </a>
                            <button class="btn btn-outline-success btn-sm text-start">
                                <i class="fas fa-user-plus me-2"></i> Tambah Warga
                            </button>
                            <button class="btn btn-outline-warning btn-sm text-start">
                                <i class="fas fa-calendar-plus me-2"></i> Buat Kegiatan
                            </button>
                            <button class="btn btn-outline-info btn-sm text-start">
                                <i class="fas fa-file-alt me-2"></i> Generate Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>