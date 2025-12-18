@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" 
         style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; border: none; border-radius: var(--border-radius); box-shadow: var(--shadow-sm);">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
         style="background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; border: none; border-radius: var(--border-radius); box-shadow: var(--shadow-sm);">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
    </div>
    @endif

    <!-- Statistik Card -->
    <div class="row mb-4 fade-in">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon primary">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stats-number">{{ $lembagaDesas->total() }}</div>
                <div class="stats-label">Total Lembaga</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(240, 104, 204, 0.1);">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background: var(--primary);"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon success">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="stats-number">{{ $lembagaDesas->whereNotNull('kontak')->count() }}</div>
                <div class="stats-label">Dengan Kontak</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(72, 187, 120, 0.1);">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $lembagaDesas->total() ? ($lembagaDesas->whereNotNull('kontak')->count()/$lembagaDesas->total())*100 : 0 }}%; background: var(--success);"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon warning">
                    <i class="fas fa-phone-slash"></i>
                </div>
                <div class="stats-number">{{ $lembagaDesas->whereNull('kontak')->count() }}</div>
                <div class="stats-label">Tanpa Kontak</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(237, 137, 54, 0.1);">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $lembagaDesas->total() ? ($lembagaDesas->whereNull('kontak')->count()/$lembagaDesas->total())*100 : 0 }}%; background: var(--warning);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card fade-in">
        <div class="content-header">
            <h1 class="content-title">
                <i class="fas fa-building me-2"></i>Data Lembaga Desa
            </h1>
            <div class="d-flex gap-2">
                <!-- Filter Button -->
                <button class="btn-crud btn-kembali" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <!-- Tambah Lembaga Button -->
                <a href="{{ route('lembaga.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Lembaga
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card" style="border: 1px solid rgba(240, 104, 204, 0.2); border-radius: 12px;">
                <div class="card-body">
                    <form method="GET" action="{{ route('lembaga.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="color: var(--dark); font-weight: 500;">Status Kontak</label>
                            <select name="filter_kontak" class="form-control" style="border-radius: 12px; border: 1px solid var(--gray-light); padding: 10px;">
                                <option value="">Semua Status</option>
                                <option value="ada" {{ request('filter_kontak') == 'ada' ? 'selected' : '' }}>Ada Kontak</option>
                                <option value="tidak_ada" {{ request('filter_kontak') == 'tidak_ada' ? 'selected' : '' }}>Tidak Ada Kontak</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color: var(--dark); font-weight: 500;">Nama Lembaga</label>
                            <input type="text" name="search" class="form-control" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari nama lembaga atau deskripsi..."
                                   style="border-radius: 12px; border: 1px solid var(--gray-light); padding: 10px;">
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn-crud btn-simpan">
                                    <i class="fas fa-filter"></i> Terapkan Filter
                                </button>
                                <a href="{{ route('lembaga.index') }}" class="btn-crud btn-kembali">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Data -->
        <div class="table-container">
            @if($lembagaDesas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Lembaga</th>
                            <th>Deskripsi</th>
                            <th>Kontak</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lembagaDesas as $lembaga)
                        <tr>
                            <td class="fw-bold" style="color: var(--dark-light);">
                                {{ ($lembagaDesas->currentPage() - 1) * $lembagaDesas->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon primary" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-bold" style="color: var(--dark);">{{ $lembaga->nama_lembaga }}</div>
                                        <small class="text-muted">ID: {{ $lembaga->lembaga_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td style="max-width: 300px;">
                                <div class="text-truncate" style="color: var(--gray);">
                                    {{ $lembaga->deskripsi ? Str::limit($lembaga->deskripsi, 100) : 'Tidak ada deskripsi' }}
                                </div>
                            </td>
                            <td>
                                @if($lembaga->kontak)
                                    <span class="badge" style="background: rgba(72, 187, 120, 0.15); color: var(--success); padding: 6px 12px; border-radius: 8px;">
                                        <i class="fas fa-phone me-1"></i> {{ $lembaga->kontak }}
                                    </span>
                                @else
                                    <span class="badge" style="background: rgba(237, 137, 54, 0.15); color: var(--warning); padding: 6px 12px; border-radius: 8px;">
                                        <i class="fas fa-phone-slash me-1"></i> Belum ada
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('lembaga.show', $lembaga->lembaga_id) }}" 
                                       class="btn-crud btn-detail btn-sm" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" 
                                       class="btn-crud btn-edit btn-sm" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lembaga.destroy', $lembaga->lembaga_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin menghapus lembaga {{ $lembaga->nama_lembaga }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-crud btn-hapus btn-sm" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <!-- Empty State -->
            <div class="empty-state text-center py-5">
                <i class="fas fa-building" style="font-size: 4rem; color: var(--primary-light); opacity: 0.5;"></i>
                <h4 class="mt-3 mb-2" style="color: var(--dark);">Tidak ada data Lembaga Desa</h4>
                <p class="text-muted mb-4">Belum ada data lembaga desa yang tersimpan.</p>
                <a href="{{ route('lembaga.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Lembaga Pertama
                </a>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($lembagaDesas->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $lembagaDesas->firstItem() }} - {{ $lembagaDesas->lastItem() }} dari {{ $lembagaDesas->total() }} data
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    @if ($lembagaDesas->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light);">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $lembagaDesas->previousPageUrl() }}" 
                               style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light); color: var(--primary);">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($lembagaDesas->links()->elements[0] as $page => $url)
                        @if ($page == $lembagaDesas->currentPage())
                            <li class="page-item active">
                                <span class="page-link" 
                                      style="border-radius: 12px; margin: 0 3px; background: var(--primary-gradient); border: none;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}" 
                                   style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light); color: var(--dark);">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($lembagaDesas->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $lembagaDesas->nextPageUrl() }}" 
                               style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light); color: var(--primary);">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light);">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

<!-- WhatsApp Float Button -->
<a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20lembaga%20desa" 
   class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Tambahkan script untuk statistik -->
@push('scripts')
<script>
    // Animasi untuk statistik cards
    document.addEventListener('DOMContentLoaded', function() {
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Toggle filter
        const filterToggle = document.querySelector('[data-bs-target="#filterCollapse"]');
        if (filterToggle) {
            filterToggle.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-filter')) {
                    icon.classList.replace('fa-filter', 'fa-times');
                } else {
                    icon.classList.replace('fa-times', 'fa-filter');
                }
            });
        }

        // Auto close alert setelah 5 detik
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endpush
@endsection