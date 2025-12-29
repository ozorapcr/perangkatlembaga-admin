# Buat file index.blade.php
cat > resources/views/anggota-lembaga/index.blade.php << 'EOF'
@extends('layouts.app')

@section('title', 'Anggota Lembaga')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Daftar Anggota Lembaga</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('anggota-lembaga.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Anggota
                    </a>
                </div>
                <form action="{{ route('anggota-lembaga.index') }}" method="GET" class="d-flex flex-wrap gap-2">
                    <input type="text" name="search" class="form-control me-2" style="width: 200px;" placeholder="Cari..." value="{{ request('search') }}">
                    <select name="lembaga_id" class="form-control me-2" style="width: 200px;">
                        <option value="">Pilih Lembaga</option>
                        @foreach($lembagas as $lembaga)
                            <option value="{{ $lembaga->lembaga_id }}" {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                {{ $lembaga->nama_lembaga }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-redo"></i>
                    </a>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>Lembaga</th>
                            <th>Jabatan</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotaLembagas as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($anggotaLembagas->currentPage() - 1) * $anggotaLembagas->perPage() }}</td>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->lembaga->nama_lembaga ?? '-' }}</td>
                            <td>{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                            <td>{{ $item->tgl_mulai->format('d/m/Y') }}</td>
                            <td>{{ $item->tgl_selesai ? $item->tgl_selesai->format('d/m/Y') : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $item->isAktif() ? 'success' : 'danger' }}">
                                    {{ $item->isAktif() ? 'Aktif' : 'Non Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('anggota-lembaga.show', $item->anggota_id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('anggota-lembaga.edit', $item->anggota_id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('anggota-lembaga.destroy', $item->anggota_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $anggotaLembagas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
EOF