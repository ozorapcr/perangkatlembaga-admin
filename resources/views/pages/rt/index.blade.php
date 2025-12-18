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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon primary">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stats-number">{{ $totalRT ?? 0 }}</div>
                <div class="stats-label">Total RT</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(240, 104, 204, 0.1);">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background: var(--primary);"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stats-number">{{ $rtWithKetua ?? 0 }}</div>
                <div class="stats-label">RT dengan Ketua</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(72, 187, 120, 0.1);">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $totalRT ? ($rtWithKetua/$totalRT)*100 : 0 }}%; background: var(--success);"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon warning">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stats-number">{{ $rtWithoutKetua ?? 0 }}</div>
                <div class="stats-label">RT tanpa Ketua</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(237, 137, 54, 0.1);">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $totalRT ? ($rtWithoutKetua/$totalRT)*100 : 0 }}%; background: var(--warning);"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon info">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number">{{ $totalRW ?? 0 }}</div>
                <div class="stats-label">Total RW</div>
                <div class="progress mt-3" style="height: 6px; background: rgba(66, 153, 225, 0.1);">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background: var(--info);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card fade-in">
        <div class="content-header">
            <h1 class="content-title">
                <i class="fas fa-home me-2"></i>Data RT
            </h1>
            <div class="d-flex gap-2">
                <!-- Filter Button -->
                <button class="btn-crud btn-kembali" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <!-- Tambah RT Button -->
                <a href="{{ route('rt.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah RT
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card" style="border: 1px solid rgba(240, 104, 204, 0.2); border-radius: 12px;">
                <div class="card-body">
                    <form method="GET" action="{{ route('rt.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" style="color: var(--dark); font-weight: 500;">RW</label>
                            <select name="rw_id" class="form-control" style="border-radius: 12px; border: 1px solid var(--gray-light); padding: 10px;">
                                <option value="">Semua RW</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ request('rw_id') == $rw->id ? 'selected' : '' }}>
                                        RW {{ $rw->nomorRw }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color: var(--dark); font-weight: 500;">Nomor RT</label>
                            <input type="text" name="nomor_rt" class="form-control" 
                                   value="{{ request('nomor_rt') }}" 
                                   placeholder="Cari nomor RT"
                                   style="border-radius: 12px; border: 1px solid var(--gray-light); padding: 10px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color: var(--dark); font-weight: 500;">Status Ketua</label>
                            <select name="filter_ketua" class="form-control" style="border-radius: 12px; border: 1px solid var(--gray-light); padding: 10px;">
                                <option value="">Semua</option>
                                <option value="ada" {{ request('filter_ketua') == 'ada' ? 'selected' : '' }}>Ada Ketua</option>
                                <option value="tidak_ada" {{ request('filter_ketua') == 'tidak_ada' ? 'selected' : '' }}>Tidak Ada Ketua</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn-crud btn-simpan">
                                    <i class="fas fa-filter"></i> Terapkan Filter
                                </button>
                                <a href="{{ route('rt.index') }}" class="btn-crud btn-kembali">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('rt.index') }}" class="mb-4">
            <div class="input-group" style="border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <input type="text" name="search" class="form-control" 
                       value="{{ request('search') }}" 
                       placeholder="Cari berdasarkan nomor RT atau keterangan..."
                       style="border: none; padding: 15px; font-size: 0.95rem;">
                <button class="btn" type="submit" 
                        style="background: var(--primary-gradient); color: white; border: none; padding: 0 25px;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <!-- Table Data -->
        <div class="table-container">
            @if($rts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>RW</th>
                            <th>Nomor RT</th>
                            <th>Ketua RT</th>
                            <th>Keterangan</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rts as $rt)
                        <tr>
                            <td class="fw-bold" style="color: var(--dark-light);">
                                {{ $loop->iteration + ($rts->currentPage() - 1) * $rts->perPage() }}
                            </td>
                            <td>
                                <span class="badge" style="background: var(--primary-gradient); color: white; padding: 6px 12px; border-radius: 8px;">
                                    RW {{ $rt->rw->nomorRw ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold" style="color: var(--dark); font-size: 1.1rem;">
                                    {{ $rt->nomor_rt }}
                                </span>
                            </td>
                            <td>
                                @if($rt->ketua_rt_warga_id)
                                    <span class="badge" style="background: rgba(72, 187, 120, 0.15); color: var(--success); padding: 6px 12px; border-radius: 8px;">
                                        <i class="fas fa-user-check me-1"></i> ID: {{ $rt->ketua_rt_warga_id }}
                                    </span>
                                @else
                                    <span class="badge" style="background: rgba(237, 137, 54, 0.15); color: var(--warning); padding: 6px 12px; border-radius: 8px;">
                                        <i class="fas fa-user-times me-1"></i> Belum ada
                                    </span>
                                @endif
                            </td>
                            <td style="max-width: 200px;">
                                <div class="text-truncate" style="color: var(--gray);">
                                    {{ $rt->keterangan ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('rt.show', $rt->rt_id) }}" 
                                       class="btn-crud btn-detail btn-sm" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('rt.edit', $rt->rt_id) }}" 
                                       class="btn-crud btn-edit btn-sm" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('rt.destroy', $rt->rt_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin menghapus RT {{ $rt->nomor_rt }}?')">
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
                <i class="fas fa-home" style="font-size: 4rem; color: var(--primary-light); opacity: 0.5;"></i>
                <h4 class="mt-3 mb-2" style="color: var(--dark);">Tidak ada data RT</h4>
                <p class="text-muted mb-4">Belum ada data RT yang tersimpan.</p>
                <a href="{{ route('rt.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah RT Pertama
                </a>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($rts->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $rts->firstItem() }} - {{ $rts->lastItem() }} dari {{ $rts->total() }} data
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    @if ($rts->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light);">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $rts->previousPageUrl() }}" 
                               style="border-radius: 12px; margin: 0 3px; border: 1px solid var(--gray-light); color: var(--primary);">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($rts->links()->elements[0] as $page => $url)
                        @if ($page == $rts->currentPage())
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
                    @if ($rts->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $rts->nextPageUrl() }}" 
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
<a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20data%20RT" 
   class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Tambahkan script untuk statistik jika belum ada di controller -->
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
    });
</script>
@endpush
@endsection