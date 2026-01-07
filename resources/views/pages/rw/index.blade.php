@extends('layouts.app')

@section('content')
<div class="main-content">

    {{-- SUCCESS / ERROR --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
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
                <div class="stats-number">{{ $totalRw ?? 0 }}</div>
                <div class="stats-label">Total RW</div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stats-number">{{ $rwWithKetua ?? 0 }}</div>
                <div class="stats-label">RW dengan Ketua</div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon warning">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stats-number">{{ $rwWithoutKetua ?? 0 }}</div>
                <div class="stats-label">RW tanpa Ketua</div>
            </div>
        </div>
    </div>


    {{-- ==== HEADER CONTENT ==== --}}
    <div class="content-card">

        <div class="content-header">
            <h1 class="content-title">
                <i class="fas fa-users me-2"></i> Data RW
            </h1>

            <div class="d-flex gap-2">
                <button class="btn-crud btn-kembali" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('rw.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah RW
                </a>
            </div>
        </div>


        {{-- ==== FILTER ==== --}}
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('rw.index') }}" class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Nomor RW</label>
                            <input type="text" name="nomor_rw" class="form-control"
                                   value="{{ request('nomor_rw') }}" placeholder="Cari nomor RW">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status Ketua</label>
                            <select name="filter_ketua" class="form-control">
                                <option value="">Semua</option>
                                <option value="ada" {{ request('filter_ketua')=='ada'?'selected':'' }}>Ada</option>
                                <option value="tidak_ada" {{ request('filter_ketua')=='tidak_ada'?'selected':'' }}>Tidak Ada</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100 justify-content-end">
                                <button class="btn-crud btn-simpan">
                                    <i class="fas fa-filter"></i> Terapkan
                                </button>

                                <a href="{{ route('rw.index') }}" class="btn-crud btn-kembali">
                                    Reset
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        {{-- ==== SEARCH BAR ==== --}}
        <form method="GET" action="{{ route('rw.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Cari RW / keterangan...">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>


        {{-- ==== TABLE ==== --}}
        <div class="table-container">

            @if($rws->count())

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor RW</th>
                        <th>Ketua RW</th>
                        <th>Keterangan</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rws as $rw)
                    <tr>
                        <td>{{ $loop->iteration + ($rws->currentPage()-1)*$rws->perPage() }}</td>

                        <td>
                            <span class="badge bg-primary">
                                RW {{ $rw->nomorRw }}
                            </span>
                        </td>

                         <td>
                                    @if($rw->ketua)
                                        <span class="badge bg-success">
                                            {{ $rw->ketua->nama }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Belum ada Ketua
                                        </span>
                                    @endif
                                </td>

                        <td>{{ $rw->keterangan ?? '-' }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                

                                <a href="{{ route('rw.edit', $rw->id) }}" class="btn-crud btn-edit btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('rw.destroy', $rw->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus RW {{ $rw->nomorRw }}?')">
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
                <h4>Tidak ada data RW</h4>
                <a href="{{ route('rw.create') }}" class="btn-crud btn-tambah">
                    Tambah RW
                </a>
            </div>

            @endif
        </div>


        {{-- ==== PAGINATION ==== --}}
        @if($rws->hasPages())
        <div class="d-flex justify-content-between mt-3">
            <span>
                Menampilkan {{ $rws->firstItem() }} - {{ $rws->lastItem() }} dari {{ $rws->total() }}
            </span>

            {{ $rws->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
