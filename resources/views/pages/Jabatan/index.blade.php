{{-- resources/views/jabatan-lembaga/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Jabatan Lembaga')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Jabatan Lembaga</h4>
                    <a href="{{ route('jabatan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Jabatan
                    </a>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('jabatan.index') }}" class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Cari</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Cari nama jabatan...">
                        </div>
                        <div class="col-md-3">
                            <label for="lembaga_id" class="form-label">Lembaga</label>
                            <select class="form-control" id="lembaga_id" name="lembaga_id">
                                <option value="">Semua Lembaga</option>
                                @foreach($lembagas as $lembaga)
                                    <option value="{{ $lembaga->lembaga_id }}" 
                                            {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                        {{ $lembaga->nama_lembaga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="level" class="form-label">Level</label>
                            <input type="number" class="form-control" id="level" name="level" 
                                   value="{{ request('level') }}" placeholder="Level" min="1">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-info me-2">
                                <i class="bi bi-filter"></i> Filter
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Lembaga</th>
                                    <th>Level</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jabatanLembagas as $index => $jabatan)
                                <tr>
                                    <td>{{ $jabatanLembagas->firstItem() + $index }}</td>
                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                    <td>{{ $jabatan->lembaga->nama_lembaga }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $jabatan->level }}</span>
                                    </td>
                                    <td>{{ $jabatan->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('jabatan.show', $jabatan->jabatan_id) }}" 
                                           class="btn btn-sm btn-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('jabatan.edit', $jabatan->jabatan_id) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('jabatan.destroy', $jabatan->jabatan_id) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Hapus jabatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data jabatan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $jabatanLembagas->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection