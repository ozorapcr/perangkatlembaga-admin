@extends('layouts.app')

@section('title', 'Jabatan Lembaga')

@section('content')
    <div class="main-content">

        <!-- Main Content Card -->
        <div class="content-card fade-in">

            <div class="content-header">
                <h1 class="content-title">
                    <i class="fas fa-user-tie me-2"></i>Data Jabatan Lembaga
                </h1>

                <div class="d-flex gap-2">
                    <!-- Filter -->
                    <button class="btn-crud btn-kembali" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse">
                        <i class="fas fa-filter"></i> Filter
                    </button>

                    <!-- Tambah -->
                    <a href="{{ route('jabatan.create') }}" class="btn-crud btn-tambah">
                        <i class="fas fa-plus"></i> Tambah Jabatan
                    </a>
                </div>
            </div>

            <!-- Filter -->
            <div class="collapse mb-4" id="filterCollapse">
                <div class="card" style="border-radius: 12px;">
                    <div class="card-body">
                        <form method="GET" action="{{ route('jabatan.index') }}" class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Cari Jabatan</label>
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari nama jabatan...">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Lembaga</label>
                                <select name="lembaga_id" class="form-control">
                                    <option value="">Semua Lembaga</option>
                                    @foreach ($lembagas as $lembaga)
                                        <option value="{{ $lembaga->lembaga_id }}"
                                            {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                            {{ $lembaga->nama_lembaga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Level</label>
                                <input type="number" name="level" class="form-control" value="{{ request('level') }}"
                                    placeholder="Level">
                            </div>

                            <div class="col-md-2 d-flex align-items-end justify-content-end">
                                <button type="submit" class="btn-crud btn-simpan me-2">
                                    <i class="fas fa-filter"></i> Terapkan
                                </button>

                                <a href="{{ route('jabatan.index') }}" class="btn-crud btn-kembali">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-container">

                @if ($jabatanLembagas->count() > 0)

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">

                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Lembaga</th>
                                    <th width="90">Level</th>
                                    <th width="140">Dibuat</th>
                                    <th width="160" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jabatanLembagas as $index => $jabatan)
                                    <tr>
                                        <td class="fw-bold">
                                            {{ $jabatanLembagas->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="fw-bold">{{ $jabatan->nama_jabatan }}</div>
                                            <small class="text-muted">
                                                ID: {{ $jabatan->jabatan_id }}
                                            </small>
                                        </td>

                                        <td>{{ $jabatan->lembaga->nama_lembaga }}</td>

                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $jabatan->level }}
                                            </span>
                                        </td>

                                        <td>{{ $jabatan->created_at->format('d/m/Y') }}</td>

                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                              

                                                <a href="{{ route('jabatan.edit', $jabatan->jabatan_id) }}"
                                                    class="btn-crud btn-edit btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('jabatan.destroy', $jabatan->jabatan_id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus jabatan ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn-crud btn-hapus btn-sm">
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
                        <i class="fas fa-user-tie" style="font-size: 4rem; opacity: .4;"></i>
                        <h4 class="mt-3">Belum ada data jabatan</h4>
                        <p class="text-muted">Tambahkan jabatan pertama sekarang.</p>

                        <a href="{{ route('jabatan.create') }}" class="btn-crud btn-tambah">
                            <i class="fas fa-plus"></i> Tambah Jabatan
                        </a>
                    </div>

                @endif
            </div>

            <!-- PAGINATION -->
            @if ($jabatanLembagas->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Menampilkan {{ $jabatanLembagas->firstItem() }} - {{ $jabatanLembagas->lastItem() }}
                        dari {{ $jabatanLembagas->total() }} data
                    </div>

                    {{ $jabatanLembagas->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
