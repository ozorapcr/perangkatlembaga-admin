@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Daftar RT</h2>
                    <a href="{{ route('rt.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah RT
                    </a>
                </div>
                <div class="card-body">
                    <!-- Form Filter dan Search -->
                    <form method="GET" action="{{ route('rt.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="rw_id" class="form-label">Filter RW:</label>
                                <select name="rw_id" class="form-control">
                                    <option value="">Semua RW</option>
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->id }}" {{ request('rw_id') == $rw->id ? 'selected' : '' }}>
                                            RW {{ $rw->nomorRw }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="nomor_rt" class="form-label">Filter Nomor RT:</label>
                                <input type="text" name="nomor_rt" class="form-control" 
                                       value="{{ request('nomor_rt') }}" placeholder="Cari nomor RT...">
                            </div>
                            <div class="col-md-3">
                                <label for="filter_ketua" class="form-label">Status Ketua:</label>
                                <select name="filter_ketua" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="ada" {{ request('filter_ketua') == 'ada' ? 'selected' : '' }}>Ada Ketua</option>
                                    <option value="tidak_ada" {{ request('filter_ketua') == 'tidak_ada' ? 'selected' : '' }}>Tidak Ada Ketua</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="search" class="form-label">Pencarian Global:</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           value="{{ request('search') }}" placeholder="Cari data RT...">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Terapkan Filter
                                </button>
                                <a href="{{ route('rt.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Statistik Cepat -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total RT</h6>
                                            <h2 class="mb-0">{{ $totalRT ?? 0 }}</h2>
                                        </div>
                                        <i class="fas fa-home fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">RT dengan Ketua</h6>
                                            <h2 class="mb-0">{{ $rtWithKetua ?? 0 }}</h2>
                                        </div>
                                        <i class="fas fa-user-check fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">RT tanpa Ketua</h6>
                                            <h2 class="mb-0">{{ $rtWithoutKetua ?? 0 }}</h2>
                                        </div>
                                        <i class="fas fa-user-times fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total RW</h6>
                                            <h2 class="mb-0">{{ $totalRW ?? 0 }}</h2>
                                        </div>
                                        <i class="fas fa-users fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">RW</th>
                                    <th width="15%">Nomor RT</th>
                                    <th width="20%">Ketua RT (Warga ID)</th>
                                    <th width="35%">Keterangan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rws as $rt)
                                <tr>
                                    <td>{{ ($rws->currentPage() - 1) * $rws->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            RW {{ $rt->rw->nomorRw ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $rt->nomor_rt }}</strong>
                                    </td>
                                    <td>
                                        @if($rt->ketua_rt_warga_id)
                                            <span class="badge bg-success">
                                                <i class="fas fa-user-check me-1"></i> {{ $rt->ketua_rt_warga_id }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-user-times me-1"></i> Belum ada
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rt->keterangan)
                                            {{ Str::limit($rt->keterangan, 100) }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('rw.show', $rw->id) }}" 
                                               class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('rw.edit', $rt->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('rw.destroy', $rw->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus RT {{ $rt->nomor_rt }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-home fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Tidak ada data RT ditemukan</p>
                                            <a href="{{ route('rt.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Tambah RT Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $rws->firstItem() ?? 0 }} - {{ $rws->lastItem() ?? 0 }} dari {{ $rws->total() }} data
                        </div>
                        <div>
                            {{ $rws->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .btn-group {
        gap: 5px;
    }
    .btn-group form {
        margin: 0;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    .card-title {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto close alert setelah 5 detik
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });










        
    }, 5000);
</script>
@endpush