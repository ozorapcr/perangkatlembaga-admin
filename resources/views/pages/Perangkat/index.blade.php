@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Perangkat Desa</h6>
                    <a href="{{ route('perangkat.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Perangkat
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Filter dan Search -->
                    <form method="GET" action="{{ route('perangkat.index') }}" class="mb-4">
                        <div class="row g-3">
                            <!-- Filter Jabatan -->
                            <div class="col-md-3">
                                <label for="jabatan" class="form-label small fw-bold">Filter Jabatan:</label>
                                <select name="jabatan" id="jabatan" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Semua Jabatan</option>
                                    <option value="Kepala Desa" {{ request('jabatan') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                                    <option value="Sekretaris Desa" {{ request('jabatan') == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                                    <option value="Bendahara Desa" {{ request('jabatan') == 'Bendahara Desa' ? 'selected' : '' }}>Bendahara Desa</option>
                                    <option value="Kasi Pemerintahan" {{ request('jabatan') == 'Kasi Pemerintahan' ? 'selected' : '' }}>Kasi Pemerintahan</option>
                                    <option value="Kasi Kesejahteraan" {{ request('jabatan') == 'Kasi Kesejahteraan' ? 'selected' : '' }}>Kasi Kesejahteraan</option>
                                    <option value="Kasi Pelayanan" {{ request('jabatan') == 'Kasi Pelayanan' ? 'selected' : '' }}>Kasi Pelayanan</option>
                                    <option value="Kadus" {{ request('jabatan') == 'Kadus' ? 'selected' : '' }}>Kepala Dusun</option>
                                    <option value="Staf" {{ request('jabatan') == 'Staf' ? 'selected' : '' }}>Staf</option>
                                </select>
                            </div>

                            <!-- Search -->
                            <div class="col-md-4">
                                <label for="search" class="form-label small fw-bold">Search:</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" 
                                           value="{{ request('search') }}" placeholder="Search jabatan, NIP, kontak..." 
                                           aria-label="Search">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('perangkat.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-refresh"></i> Reset All
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Table dengan horizontal scroll -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">No</th>
                                    <th width="80">Foto</th>
                                    <th>Nama Warga</th>
                                    <th>Jabatan</th>
                                    <th width="120">NIP</th>
                                    <th width="120">Kontak</th>
                                    <th width="200">Periode</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $i => $row)
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td class="text-center">
                                        @if($row->foto)
                                            <img src="{{ Storage::url($row->foto) }}" alt="Foto Profil" 
                                                 class="rounded-circle border" 
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 onerror="this.onerror=null; this.src='//via.placeholder.com/50x50?text=No+Image';">
                                        @else
                                            <!-- Avatar dengan inisial nama -->
                                            @php
                                                $nama = $row->warga->nama ?? 'Unknown';
                                                $names = explode(' ', $nama);
                                                $initials = '';
                                                foreach ($names as $name) {
                                                    $initials .= strtoupper(substr($name, 0, 1));
                                                }
                                                $initials = substr($initials, 0, 2);
                                                $colors = ['primary', 'success', 'danger', 'warning', 'info', 'secondary'];
                                                $color = $colors[array_rand($colors)];
                                            @endphp
                                            <div class="bg-{{ $color }} text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px; font-weight: bold; font-size: 14px;"
                                                 title="{{ $row->warga->nama ?? '-' }}">
                                                {{ $initials }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $row->warga->nama ?? '-' }}</div>
                                        <small class="text-muted">ID: {{ $row->warga_id }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $row->jabatan }}</span>
                                    </td>
                                    <td>
                                        <small class="text-truncate d-inline-block" style="max-width: 110px;" 
                                               title="{{ $row->nip ?? '-' }}">
                                            {{ $row->nip ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <small class="text-truncate d-inline-block" style="max-width: 110px;" 
                                               title="{{ $row->kontak ?? '-' }}">
                                            {{ $row->kontak ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <small>
                                            <div><strong>Mulai:</strong> {{ $row->periode_mulai ? date('d/m/Y', strtotime($row->periode_mulai)) : '-' }}</div>
                                            <div><strong>Selesai:</strong> {{ $row->periode_selesai ? date('d/m/Y', strtotime($row->periode_selesai)) : '-' }}</div>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('perangkat.edit', $row->id) }}" 
                                               class="btn btn-warning" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('perangkat.destroy', $row->id) }}" method="POST" 
                                                  style="display:inline-block" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data perangkat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <br>
                                            @if(request('jabatan') || request('search'))
                                                Tidak ada data perangkat yang sesuai dengan filter
                                            @else
                                                Tidak ada data perangkat
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Info jumlah data -->
                    @if($data->count() > 0)
                        <div class="mt-3 text-muted small">
                            Menampilkan <strong>{{ $data->count() }}</strong> data perangkat
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table-responsive {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}
.table th {
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    font-size: 0.875rem;
}
.table td {
    font-size: 0.875rem;
    vertical-align: middle;
}
.badge {
    font-size: 0.75rem;
}
</style>
@endsection