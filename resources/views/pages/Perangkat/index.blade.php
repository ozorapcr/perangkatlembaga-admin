
@extends('layouts.app')

@section('content')
<div class="main-content">

    {{-- ==== SUCCESS / ERROR ==== --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    {{-- ==== STATISTIK ==== --}}
    <div class="row mb-4">

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon info">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number">{{ $data->count() ?? 0 }}</div>
                <div class="stats-label">Total Perangkat</div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon success">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stats-number">
                    {{ $data->where('jabatan','Kepala Desa')->count() ?? 0 }}
                </div>
                <div class="stats-label">Kepala Desa</div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon warning">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stats-number">
                    {{ $data->where('jabatan','!=','Kepala Desa')->count() ?? 0 }}
                </div>
                <div class="stats-label">Perangkat Lainnya</div>
            </div>
        </div>

    </div>


    {{-- ==== HEADER CONTENT ==== --}}
    <div class="content-card">

        <div class="content-header">
            <h1 class="content-title">
                <i class="fas fa-user-tie me-2"></i> Data Perangkat Desa
            </h1>

            <div class="d-flex gap-2">
                <button class="btn-crud btn-kembali"
                        data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('perangkat.create') }}" class="btn-crud btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Perangkat
                </a>
            </div>
        </div>


        {{-- ==== FILTER ==== --}}
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card">
                <div class="card-body">

                    <form method="GET" action="{{ route('perangkat.index') }}" class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Filter Jabatan</label>
                            <select name="jabatan" class="form-control">
                                <option value="">Semua Jabatan</option>
                                <option value="Kepala Desa" {{ request('jabatan')=='Kepala Desa'?'selected':'' }}>Kepala Desa</option>
                                <option value="Sekretaris Desa" {{ request('jabatan')=='Sekretaris Desa'?'selected':'' }}>Sekretaris Desa</option>
                                <option value="Bendahara Desa" {{ request('jabatan')=='Bendahara Desa'?'selected':'' }}>Bendahara Desa</option>
                                <option value="Kasi Pemerintahan" {{ request('jabatan')=='Kasi Pemerintahan'?'selected':'' }}>Kasi Pemerintahan</option>
                                <option value="Kasi Kesejahteraan" {{ request('jabatan')=='Kasi Kesejahteraan'?'selected':'' }}>Kasi Kesejahteraan</option>
                                <option value="Kasi Pelayanan" {{ request('jabatan')=='Kasi Pelayanan'?'selected':'' }}>Kasi Pelayanan</option>
                                <option value="Kadus" {{ request('jabatan')=='Kadus'?'selected':'' }}>Kepala Dusun</option>
                                <option value="Staf" {{ request('jabatan')=='Staf'?'selected':'' }}>Staf</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama, jabatan, NIP ...">
                        </div>

                        <div class="col-md-4 d-flex align-items-end justify-content-end gap-2">
                            <button class="btn-crud btn-simpan">
                                Terapkan
                            </button>

                            <a href="{{ route('perangkat.index') }}" class="btn-crud btn-kembali">
                                Reset
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>


        {{-- ==== TABLE ==== --}}
        <div class="table-container">

            @if($data->count())

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>NIP</th>
                        <th>Kontak</th>
                        <th>Periode</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">
                                        @if($row->foto)
                                            {{-- MENGGUNAKAN HELPER ASSET DENGAN PATH 'storage/' --}}
                                            <img src="{{ asset('storage/' . $row->foto) }}"
                                                alt="Foto Profil"
                                                class="rounded-circle border"
                                                style="width: 50px; height: 50px; object-fit: cover;"
                                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($row->warga->nama ?? 'Unknown') }}&background=E91E63&color=fff&size=50';">
                                        @else
                                            @php
                                                $nama = $row->warga->nama ?? 'Unknown';
                                                $names = explode(' ', $nama);
                                                // Ambil inisial 2 kata pertama atau 1 kata pertama
                                                $initials = (count($names) > 1) ?
                                                            strtoupper(substr($names[0], 0, 1) . substr(end($names), 0, 1)) :
                                                            strtoupper(substr($names[0], 0, 1));
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
                        <td>{{ $row->warga->nama ?? '-' }}</td>


                        <td>
                            <span class="badge bg-primary">{{ $row->jabatan }}</span>
                        </td>

                        <td>{{ $row->nip ?? '-' }}</td>

                        <td>{{ $row->kontak ?? '-' }}</td>

                        <td>
                            {{ $row->periode_mulai ? date('d/m/Y', strtotime($row->periode_mulai)) : '-' }}
                            s/d
                            {{ $row->periode_selesai ? date('d/m/Y', strtotime($row->periode_selesai)) : '-' }}
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('perangkat.show', $row->id) }}" class="btn-crud btn-detail btn-sm">
                                       <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('perangkat.edit', $row->id) }}" class="btn-crud btn-edit btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('perangkat.destroy', $row->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                <h4>Tidak ada data perangkat</h4>
            </div>

            @endif

        </div>

    </div>

</div>
@endsection

