@extends('layouts.app')

@section('content')
    <div class="main-content">

        {{-- SUCCESS / ERROR --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        {{-- ==== STATISTIK ==== --}}
        <div class="row mb-4">

            <div class="col-xl-4 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-number">{{ $totalWarga ?? 0 }}</div>
                    <div class="stats-label">Total Warga</div>

                </div>
            </div>



            {{-- ==== CONTENT WRAPPER ==== --}}
            <div class="content-card">

                <div class="content-header">
                    <h1 class="content-title">
                        <i class="fas fa-users me-2"></i> Data Warga
                    </h1>

                    <div class="d-flex gap-2">
                        <button class="btn-crud btn-kembali" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                            <i class="fas fa-filter"></i> Filter
                        </button>

                        <a href="{{ route('warga.create') }}" class="btn-crud btn-tambah">
                            <i class="fas fa-plus"></i> Tambah Warga
                        </a>
                    </div>
                </div>


                {{-- ==== FILTER ==== --}}
                <div class="collapse mb-4" id="filterCollapse">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('warga.index') }}" class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label">Filter Alamat</label>
                                    <select name="alamat" class="form-control">
                                        <option value="">Semua Alamat</option>
                                        <option value="Dusun Krajan"
                                            {{ request('alamat') == 'Dusun Krajan' ? 'selected' : '' }}>
                                            Dusun Krajan</option>
                                        <option value="Dusun Sukorejo"
                                            {{ request('alamat') == 'Dusun Sukorejo' ? 'selected' : '' }}>Dusun Sukorejo
                                        </option>
                                        <option value="Dusun Sumberejo"
                                            {{ request('alamat') == 'Dusun Sumberejo' ? 'selected' : '' }}>Dusun Sumberejo
                                        </option>
                                        <option value="Dusun Sidomulyo"
                                            {{ request('alamat') == 'Dusun Sidomulyo' ? 'selected' : '' }}>Dusun Sidomulyo
                                        </option>
                                    </select>
                                </div>



                                <div class="col-md-4 d-flex align-items-end justify-content-end gap-2">
                                    <button class="btn-crud btn-simpan">
                                        <i class="fas fa-filter"></i> Terapkan
                                    </button>

                                    <a href="{{ route('warga.index') }}" class="btn-crud btn-kembali">
                                        Reset
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                {{-- ==== SEARCH ==== --}}
                <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama / NIK / alamat / no HP">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>


                {{-- ==== TABLE ==== --}}
                <div class="table-container">

                    @if ($warga->count())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th class="text-center" width="160">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($warga as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($warga->currentPage() - 1) * $warga->perPage() }}
                                            </td>

                                            <td>
                                                <strong>{{ $item->nama }}</strong>
                                            </td>

                                            <td>{{ $item->nik }}</td>

                                            <td>{{ $item->no_hp ?? '-' }}</td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $item->alamat }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('warga.edit', $item->id) }}"
                                                        class="btn-crud btn-edit btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('warga.destroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin hapus data warga ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-crud btn-hapus btn-sm">
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
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4>Tidak ada data warga</h4>
                            <a href="{{ route('warga.create') }}" class="btn-crud btn-tambah">
                                Tambah Warga
                            </a>
                        </div>
                    @endif
                </div>


                {{-- ==== PAGINATION ==== --}}
                @if ($warga->hasPages())
                    <div class="d-flex justify-content-between mt-3">
                        <span>
                            Menampilkan {{ $warga->firstItem() }} - {{ $warga->lastItem() }} dari {{ $warga->total() }}
                        </span>

                        {{ $warga->links() }}
                    </div>
                @endif

            </div>

        </div>
    @endsection
