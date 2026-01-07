@extends('layouts.app')

@section('title', 'Anggota Lembaga')

@section('content')
<div class="main-content">

    <div class="content-card fade-in">

        <div class="content-header">
            <h1 class="content-title">
                <i class="fas fa-users me-2"></i>Data Anggota Lembaga
            </h1>

            <div class="d-flex gap-2">

                <button class="btn-crud btn-kembali" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('anggota-lembaga.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card" style="border-radius: 12px;">
                <div class="card-body">

                    <form action="{{ route('anggota-lembaga.index') }}" method="GET" class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari</label>
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama warga / jabatan ...">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lembaga</label>
                            <select name="lembaga_id" class="form-control">
                                <option value="">Semua Lembaga</option>
                                @foreach($lembagas as $lembaga)
                                <option value="{{ $lembaga->lembaga_id }}"
                                    {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                    {{ $lembaga->nama_lembaga }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end justify-content-end">
                            <button type="submit" class="btn-crud btn-simpan me-2">
                                <i class="fas fa-filter"></i> Terapkan
                            </button>

                            <a href="{{ route('anggota-lembaga.index') }}" class="btn-crud btn-kembali">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-container">

            @if($anggotaLembagas->count() > 0)

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Warga</th>
                            <th>Lembaga</th>
                            <th>Jabatan</th>
                            <th width="120">Mulai</th>
                            <th width="120">Selesai</th>
                            <th width="110">Status</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($anggotaLembagas as $index => $item)

                        <tr>
                            <td class="fw-bold">
                                {{ $anggotaLembagas->firstItem() + $index }}
                            </td>

                            <td>
                                <div class="fw-bold">
                                    {{ $item->warga->nama ?? '-' }}
                                </div>
                                <small class="text-muted">
                                    NIK: {{ $item->warga->no_ktp ?? '-' }}
                                </small>
                            </td>

                            <td>{{ $item->lembaga->nama_lembaga ?? '-' }}</td>

                            <td>{{ $item->jabatan->nama_jabatan ?? '-' }}</td>

                            <td>{{ $item->tgl_mulai?->format('d/m/Y') }}</td>

                            <td>{{ $item->tgl_selesai ? $item->tgl_selesai->format('d/m/Y') : '-' }}</td>

                            <td>
                                <span class="badge bg-{{ $item->isAktif() ? 'success' : 'danger' }}">
                                    {{ $item->isAktif() ? 'Aktif' : 'Non Aktif' }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">


                                    <a href="{{ route('anggota-lembaga.edit', $item->anggota_id) }}"
                                       class="btn-crud btn-edit btn-sm">
                                       <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('anggota-lembaga.destroy', $item->anggota_id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data anggota ini?')">

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

            <div class="empty-state text-center py-5">
                <i class="fas fa-users" style="font-size: 4rem; opacity:.4;"></i>
                <h4 class="mt-3">Belum ada data anggota lembaga</h4>
                <p class="text-muted">Tambahkan anggota sekarang untuk mulai mengelola data.</p>

                <a href="{{ route('anggota-lembaga.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>

            @endif
        </div>

        {{-- PAGINATION --}}
        @if($anggotaLembagas->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">

            <div class="text-muted">
                Menampilkan
                {{ $anggotaLembagas->firstItem() }}
                -
                {{ $anggotaLembagas->lastItem() }}
                dari
                {{ $anggotaLembagas->total() }} data
            </div>

            {{ $anggotaLembagas->withQueryString()->links() }}
        </div>
        @endif

    </div>

</div>
@endsection
