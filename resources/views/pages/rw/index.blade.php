@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Daftar RW</h2>
                    <a href="{{ route('rw.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah RW
                    </a>
                </div>
                <div class="card-body">
                    <!-- Form Filter dan Search -->
                    <form method="GET" action="{{ route('rw.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="nomorRw" class="form-label">Filter Nomor RW:</label>
                                <input type="text" name="nomorRw" class="form-control" 
                                       value="{{ request('nomorRw') }}" placeholder="Cari nomor RW...">
                            </div>
                       
                            <div class="col-md-4">
                                <label for="search" class="form-label">Pencarian Global:</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           value="{{ request('search') }}" placeholder="Cari data RW...">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('rw.index') }}" class="btn btn-secondary w-100">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Nomor RW</th>
                                    <th width="20%">Ketua RW Warga ID</th>
                                    <th width="40%">Keterangan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rws as $rw)
                                <tr>
                                    <td>{{ ($rws->currentPage() - 1) * $rws->perPage() + $loop->iteration }}</td>
                                    <td>{{ $rw->nomorRw }}</td>
                                    <td>
                                        @if($rw->ketuaRwWargaId)
                                            {{ $rw->ketuaRwWargaId }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rw->keterangan)
                                            {{ $rw->keterangan }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('rw.edit', $rw->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('rw.destroy', $rw->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data RW ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data RW</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div >
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
    }
    .btn-group {
        gap: 5px;
    }
</style>
@endpush